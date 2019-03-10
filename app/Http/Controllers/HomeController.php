<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        
        $refs = \App\Ref::all()->where("user_id", \Auth::id());

        $books = \App\Book::all();

        $notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
        //dd($notifications);

        return view('home', ['refs' => $refs, 'books' => $books, 'notifications' => $notifications ] );
    }

}
