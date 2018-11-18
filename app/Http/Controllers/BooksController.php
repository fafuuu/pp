<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    
    public function index() {

        $books = Book::all();

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
        $book = Book::where('isbn', $isbn)->get();

        $var = substr($isbn, -1);

        if(is_numeric($var)) {
            $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn);
        } else {
            $name = str_replace(' ', '+', $isbn);
            $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=" . $name);
        }
  
        $data = json_decode($json);

        if(!isset($data->items)) {
           return redirect('/books/notfound');
        }
    
        if(count($book) == 0) {

            Book::create([
                'title' => $data->items[0]->volumeInfo->title,
                'isbn' => $data->items[0]->volumeInfo->industryIdentifiers[1]->identifier,
                'thumbnail' => $data->items[0]->volumeInfo->imageLinks->smallThumbnail,
                'subtitle' => $data->items[0]->volumeInfo->subtitle,
                'author' => $data->items[0]->volumeInfo->authors[0],
                'publisher' => $data->items[0]->volumeInfo->publisher,
                'pageCount' => $data->items[0]->volumeInfo->pageCount
            ]);
            
            return redirect('/books');

        } else {
            
            return redirect('/books/' . $book[0]->id);

        }

        
    }

    public function show(Book $book) {

        return view("books.show", ["book" => $book]);
    }
    
}
