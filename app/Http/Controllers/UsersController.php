<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function update(User $user) {

        $user = \Auth::user();
       
        $user->group_id = request('join');

        $user->save();

        return back();

    }

    public function index()
    {

        $user = \Auth::user();

        return view('profile.index', ['user' => $user]);
    }

    public function profile()
    {
        
    }
}
