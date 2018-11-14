<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{


    public function index() {
        
        $url = "https://www.youtube.com/watch?v=t0u_JeqGrCI";

        if(substr($url, -3) == "jpg" || "png" || "gif") {
            return view('index', ['url' => $url]);
        }
        
       else {
        $parts = parse_url($url);
        
        if($parts['host'] == 'www.youtube.com') {
            $vid = substr($parts['query'], 2);
            print_r($parts);
            
            return view('index', ['vid' => $vid]);
        }
       }


       return view('index', ['parts' => $parts]);
    }



    public function create() {

        return view('create');

    }

   
    public function store() {

        $project = new Project();

        
        $project->title = request('title');
        $project->description = request('description');

        //
        
        $project->save();

        $parts = parse_url($project->title);
        //$vid = substr($parts['query'], 2);
        
        //print_r($parts);

        return view('index', ['parts' => $parts]);
    }

}
