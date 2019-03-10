<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;

class WatchlistController extends Controller
{
    public function store()
    {

        Watchlist::create([
            'book_ids' => '[]',
            'user_id' => \Auth::user()->id
        ]);

        dd('Watchlist erstellt');
    }

    public function update(Watchlist $watchlist)
    {
        $book = request('watchlist');
        //$watchlist->book_id = $book;
        $books = $watchlist->book_ids;
        $books[] = $book;
        $watchlist->book_ids = $books;
        dd($watchlist);
        array_push($watchlist->book_ids, $book);
        $watchlist->save();

        dd($watchlist);

    }
    
}
