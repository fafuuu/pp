<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use App\Http\Resources\GroupCollection;


class GroupsController extends Controller
{

    public function store() {

        Group::create([

            'group_name' => request('group')

        ]);

        return back();
    }

    public function index() {

        $groups = Group::all();
        
        return view('groups.index', ['groups'=> $groups]);
        //return new GroupCollection($groups);

    }

    public function update(Group $group) {

        //$group->user_id = request('join');

        $test = \Auth::user()->group_id = request('join');

        $test->save();

        //$group->save();

        return back();


    }

    public function show(Group $group) {

        return view('groups.show', compact('group'));
        
    }

    public function search(Request $request) {
        $search = $request->get('q');
        
        return Group::where('group_name', 'like', '%'.$search.'%')->get();
    }

}
