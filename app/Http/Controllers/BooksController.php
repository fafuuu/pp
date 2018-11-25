<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Group;

class BooksController extends Controller
{
    
    public function index() {

        $books = Book::paginate(5);

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
           return redirect('/books/notfound');
        }

        if(count($book) > 1) {

            return view('books.list', ['book' => $book]);
        }
    
        if(count($book) == 0) {

                Book::create([
                    'title' => $data->items[0]->volumeInfo->title,
                    'isbn' => $data->items[0]->volumeInfo->industryIdentifiers[1]->identifier,
                    'thumbnail' => $data->items[0]->volumeInfo->imageLinks->smallThumbnail,
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


        if(\Auth::check()) {

            $visible_restricted = $book->refs->where('visibility', \Auth::user()->group_id);

            $refs = $visible_all->merge($visible_restricted);

        } else {

            $refs = $visible_all;
        }

        
    

        //dd($refs);

        return view("books.show", ["book" => $book, "groups" => $groups, "refs" => $refs]);
    }
    
}
