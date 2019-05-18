<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Image;

class UsersController extends Controller
{
    public function update(User $user) {

        $user = \Auth::user();
       
        $user->group_id = request('join');

        $user->save();

        return back();

    }

    public function dash() {
        return view('dashboard');
    }

    public function profile($username) {

        $user = User::all()->where('name', $username)->first();

        return view('profile.profile', ['user' => $user]);
    }

    public function update_avatar(Request $request) {

        $user = \Auth::user();

        $code_pref = request('code_preference');
        $user->code_preference = request('code_preference') ?: $user->code_preference;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $user->name . '-avatar.png';
            Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/' . $filename));
            
            $user = \Auth::user();
            $avatar_old = $user->avatar;
            $user->avatar = $filename;
            $user->name = request('username');

        }
        $user->save();

        return view('profile.index', ['user' => $user])->withSuccess('Änderungen gespeichert');

    }

    public function dash_notifications() {
        return view('dashboard_notifications');
    }

    public function notifications() {
        
    }

    public function settings(User $user) {

        $user = \Auth::user();

        return view('profile.index', ['user' => $user]);

    }

}
