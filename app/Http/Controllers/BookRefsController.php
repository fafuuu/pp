<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Ref;
use App\Group;

class BookRefsController extends Controller
{
    public function store(Book $book) {


        request()->validate([

            'link' => 'required',
            'page_number' => 'required|numeric|min:1|max:2000',

        ]);

        

        Ref::create([
            'book_id' => $book->id,
            'user_id' => \Auth::user()->id,
            'visibility' => request('visibility'),
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
