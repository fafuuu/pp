<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;

class GroupsController extends Controller
{
    public function index() {

        $groups = Group::all();
        
        return view('groups.index', ['groups'=> $groups]);

    }

    public function update(Group $group) {

        $group->user_id = request('join');

        $group->save();

        return back();

    }
}
