<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Group;
use App\User;
use Mpdf\Mpdf;



//require_once __DIR__ . 'vendor/autoload.php';

class BooksController extends Controller
{
    
    public function index() {

        $books = Book::paginate(18);

        return view('books.index', ['books' => $books] );
    }

    public function notfound() {
        return view('books.notfound');
    }

    public function create() {
        
        return view('books.create');
    }



    public function store() {

       
        $isbn = request('isbn');
       

        /*
            Some ISBN end with X -> cut that away
        */
        $var = substr($isbn, -1);

        /*
        *   Searching with isbn
        */

        if(is_numeric($var)) {
            $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn);
            $book = Book::where('isbn', $isbn)->get();
           
        } else {
       /*
        *   Searching with title
        */

            $name = str_replace(' ', '+', $isbn);
            $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=" . $name);
            $book = Book::where('title', 'like', '%'. $isbn . '%')->get();
            
            //dd($book);
        }
  
        $data = json_decode($json);
        
        

        if(!isset($data->items)) {
            //dd($isbn);
           return view('books.notfound', ['book' => $isbn]);
        }

        if(count($book) > 1) {

            return view('books.list', ['book' => $book]);
        }
    
        if(count($book) == 0) {

                Book::create([
                    'title' => $data->items[0]->volumeInfo->title,
                    'isbn' => $data->items[0]->volumeInfo->industryIdentifiers[1]->identifier ?? $data->items[0]->volumeInfo->industryIdentifiers[0]->identifier,
                    'thumbnail' => $data->items[0]->volumeInfo->imageLinks->smallThumbnail ?? '{{ assets/img/no_cover.png }}',
                    'subtitle' => $data->items[0]->volumeInfo->subtitle ?? null,
                    'author' => $data->items[0]->volumeInfo->authors[0],
                    'publisher' => $data->items[0]->volumeInfo->publisher ?? null,
                    'pageCount' => $data->items[0]->volumeInfo->pageCount
                ]);
           
            return redirect('/books');

        } elseif(count($book) == 1) {
            
            return redirect('/books/' . $book[0]->id);

        }


        
    }

    public function show(Book $book) {

        $groups = Group::all();


        $visible_all = $book->refs->where('visibility', 1);

       
        $tests = [];
        foreach($book->refs as $ref) {
            $tests[$ref->id] = $ref->where('user->role', 'Student');
        }
        

        $tt = $book->with(['refs' => function($query) {
            $query->join('users', 'refs.user_id', '=', 'users.id')->where('users.role', '=', 'Student');
        }]);

        //dd($tt);


        if(isset($_GET['dozent'])) {
            //dd("Dozent");
            $items = array();
            foreach($book->refs as $ref) {
                $items[] = $ref->where($ref->user->role, 'Dozent')->getModel();
            }
            //dd(\App\User::all());
            
        }


        if(\Auth::check()) {

            $visible_restricted = $book->refs->where('visibility', \Auth::user()->group_id);

            $refs = $visible_all->merge($visible_restricted);

        } else {

            $refs = $visible_all;
        }

        if(request('vehicle')) {
            dd(request('vehicle'));
        }

        return view("books.show", ["book" => $book, 
            "groups" => $groups, 
            "refs" => $refs    
        ]);
    }

    public function archive(Book $book) {

        $parsedown = new \Parsedown();

        $mpdf = new Mpdf();
        //$stylesheet = file_get_contents('/home/fabian/laravel/proto/public/css/prism.css');
        //$html = $parsedown->text($book->refs[18]->description);
        //dd($html);
        $mpdf->writeHTML('<h3>' . $book->title . '<h3>');
        //$mpdf->writeHTML('<img src ="' . $book->thumbnail . '" alt="..." >');
        //$mpdf->writeHTML('<img src ="/home/fabian/laravel/proto/public/img/no_cover.png" alt="..." >');

        $mpdf->writeHTML('<ul styles="float: right">
        <li>' . $book->isbn . '</li>
        <li>' . $book->author . '</li>
        <li>'. $book->publisher . '</li>
        <li>' . $book->page_number . '</li></ul><hr>'
        );

        

        foreach($book->refs as $ref) {
            $ref_list = '<ul>';
            $ref_list .= '<li>Von: ' . $ref->user->name . '<li>';
            $ref_list .= '<li>Von: ' . $ref->page_number . '<li>';
            $ref_list .= '<li>Quelle ' . '<a href ="' . $ref->link .'">' . parse_url($ref->link, PHP_URL_HOST) . '</a>'; 
            $ref_list .= '<li>Anmerkung: ' . $parsedown->text($ref->description) . '</li>';
            $ref_list .= '</ul><hr>'; 
            $mpdf->writeHTML($ref_list);
        }
        
        //$mpdf->writeHTML(file_get_contents('https://buchklub.herokuapp.com/books/' . $book->id));

        //$mpdf->WriteHTML($stylesheet, 1);

        $mpdf->Output();

    }
    
}
