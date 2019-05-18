<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
use App\Book;
use App\Collection;

class DashboardController extends Controller
{
    public function index() {
        $refs = \App\Ref::all()->where("user_id", \Auth::id());
        $books = \App\Book::all();

        

        return view('dashboard', ['refs' => $refs, 'books' => $books]);
    }

    public function notifications() {

        $refs = \App\Ref::all()->where("user_id", \Auth::id());

        $books = \App\Book::all();

        $notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->get();


        $creative_notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->where('type','App\Notifications\CreativeNotification')->get();
        //dd($notifications);

        $new_ref_notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->where('type','App\Notifications\newRefNotification')->get();

        return view('notifications', ['refs' => $refs, 
                'books' => $books,
                'creative_notifications' => $creative_notifications, 
                'new_ref_notifications' => $new_ref_notifications,
                'notifications' => $notifications
        ]);
    }

    public function settings(User $user) {

        $user = \Auth::user();

        return view('profile.index', ['user' => $user]);
    }

    public function statistics(User $user) {

        $user = \Auth::user();

        return view('statistics', ['user' => $user]);
    }

    public function watchlist(User $user) {

        $user = \Auth::user();

        $watchlist = $user->watchlist;

        return view('watchlist', ['user' => $user,
            'watchlist' => $watchlist,
               
        ]);
    }

    public function collections() {


        $book = Book::all()->where('author', 'Andrew S. Tanenbaum')->first();

        $author = $book->author;
        $author_replaced = str_replace(' ', '+', $book->author);
        
        $json = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=inauthor:" . $author_replaced . "&orderBy=relevance");
        $data = json_decode($json);
        //dd($data);
        $test = [];

        foreach($data->items as $item) {

            if((isset($item->volumeInfo->authors[0])) && $item->volumeInfo->authors[0] == $author) {
                array_push($test, $item);

            }
        }

        

        return view('collections', ['tanenbaum', $test]);
    }


}
