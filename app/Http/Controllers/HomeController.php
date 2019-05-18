<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $refs = \App\Ref::all()->where("user_id", \Auth::id());
        $books = \App\Book::all();
        $latest = $books->sortByDesc('id')->first();
        

        return view('dashboard', [
            'refs' => $refs,
            'books' => $books,
            'latest' => $latest
        ]);
    }

    public function notifications() {

        $refs = \App\Ref::all()->where("user_id", \Auth::id());

        $books = \App\Book::all();
        

        $notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->get();

        $creative_notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->where('type','App\Notifications\CreativeNotification')->get();
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



}
