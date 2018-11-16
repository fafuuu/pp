<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Ref;

class BookRefsController extends Controller
{
    public function store(Book $book) {

        Ref::create([
            'book_id' => $book->id,
            'user_id' => \Auth::user()->id,
            'link' => request('link'),
            'page_number' => request('page_number'),
            'description' => request('description')
        ]);

        return back();
        
    }

    public function update(Ref $ref) {



        if (isset($_POST['upvote'])) {
            $ref->increment('votes');
        }
        elseif (isset($_POST['downvote'])) {
            $ref->decrement('votes');
        }

        return back();
    }
}
