<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Ref;
use App\Group;
use App\User;
use App\Watchlist;
use App\Notifications\CreativeNotification;
use App\Notifications\NewRefNotification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class BookRefsController extends Controller
{
    public function store(Book $book) {


        request()->validate([

            'page_number' => 'required|numeric|min:1|max:2000',

        ]);

        $new_ref = Ref::create([
            'book_id' => $book->id,
            'user_id' => \Auth::user()->id,
            'visibility' => request('visibility'),
            'page_number' => request('page_number'),
            'description' => request('description')
        ]);

        $id = $new_ref->id;
/*
        $watchlists = Watchlist::all();
        foreach($watchlists as $watchlist) {
            $users = User::all();

        }
*/
        //$users = \DB::table('users')->join('watchlists', 'users.id', '=', 'watchlists.user_id')->get();
        
        $entries = \Auth::user()->watchlist->entries->where('book_id', $new_ref->book_id);
        
        //dd($entries);
        $users = User::all();
        //dd($users);
        foreach($users as $user) {
            if(($user->group_id == $new_ref->visibility) || $new_ref->visibility == 1 ) {
                if(count($user->watchlist->entries->where('book_id', $new_ref->book_id)) == 1) {
                    $user->notify(new NewRefNotification($new_ref));
                }
                
            }
        }

        return Redirect::to(URL::previous() . "#card" .$id)->with('created', 'Verweis wurde erfolgreich erstellt!');
        
    }

    public function update(Ref $ref) {


        if (isset($_POST['upvote'])) {
            $ref->increment('votes');
        }
        elseif (isset($_POST['downvote'])) {
            $ref->decrement('votes');
        }
        elseif (isset($_POST['creative'])) {
            $ref->increment('creative');

            if(\Auth::check() && \Auth::user()->id != $ref->user->id) {
                $ref->user->increment('score', 5);
                $ref->user->increment('badge_creative');
                $ref->user->notify(new CreativeNotification($ref));
            }
        }
        elseif (isset($_POST['costly'])) {
            $ref->increment('costly');
        }
        elseif (isset($_POST['confusing'])) {
            $ref->increment('confusing');
        }

        return back();
    }

    public function edit(Ref $ref) {

        $edit = request('edit');
        
        $ref->update([
            'description' => $edit
        ]);

        return Redirect::to(URL::previous() . "#card" . $ref->id);
    }
}
