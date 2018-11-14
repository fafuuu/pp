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
        $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn);
        //$json = file_get_contents("http://openlibrary.org/api/books?bibkeys=ISBN:" . $isbn . "&format=json");
        $data = json_decode($json);
       
            //echo $data->items[0]->volumeInfo->imageLinks->smallThumbnail;

        if(!isset($data->items)) {
           return redirect('/books/notfound');
        }
            
        Book::create([
            'title' => $data->items[0]->volumeInfo->title,
            'isbn' => $data->items[0]->volumeInfo->industryIdentifiers[1]->identifier,
            'thumbnail' => $data->items[0]->volumeInfo->imageLinks->smallThumbnail
        ]);
        
        return redirect('/books');
    }

    public function show(Book $book) {

        return view("books.show", ["book" => $book]);
    }
    
}
