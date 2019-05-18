<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\Book;
use App\Watchlist_entry;

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
        $book_id = request('watchlist');
        //$watchlist->book_id = $book;

        $book = Book::where('id', $book_id)->first();

        $watchlist = \Auth::user()->watchlist;

        if(count($watchlist->entries->where('book_id', $book_id)) > 0) {
            return back()->with('err', 'Buch schon auf der Watchlist');
        }
        
    
        $new_entry = Watchlist_entry::create([
    
            'book_id' => request('watchlist'),
            'book_info' => $book->title,
            'watchlist_id' => $watchlist->id
        ]);
    
        $new_entry->save();

        return back()->with('success', 'Buch der Watchliste hinzugefügt');
    }

    public function delete_entry() {

        $entry_id = request('delete');
        $entry = \Auth::user()->watchlist->entries->find($entry_id);
        $entry->delete();
        
        return back();

    }
    
}
