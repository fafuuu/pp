<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Ref;
use App\Group;
use App\Notifications\CreativeNotification;
use App\Notifications\NewRefNotification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


use YoutubeDl\YoutubeDl;
use YoutubeDl\Exception\CopyrightException;
use YoutubeDl\Exception\NotFoundException;
use YoutubeDl\Exception\PrivateVideoException;

class BookRefsController extends Controller
{
    public function store(Book $book) {


        request()->validate([

            'link' => 'required',
            'page_number' => 'required|numeric|min:1|max:2000',

        ]);

        

        $id = Ref::create([
            'book_id' => $book->id,
            'user_id' => \Auth::user()->id,
            'visibility' => request('visibility'),
            'link' => request('link'),
            'page_number' => request('page_number'),
            'description' => request('description')
        ])->id;

        
        return Redirect::to(URL::previous() . "#card" .$id);
        
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

            if(\Auth::check && \Auth::user()->id != $ref->user->id) {
                $ref->user->increment('score', 5);
                $ref->user->increment('badge_creative');

                $details = [$ref->id, \Auth::user()->name];
                //$details = \Auth::user()->name . " hat deinen Verweis in " . $ref->book->name . " als kreativ bewertet";
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

    public function zip(Ref $ref) {

/*
        $dl = new YoutubeDl([
            'continue' => true, // force resume of partially downloaded files. By default, youtube-dl will resume downloads if possible.
            'format' => 'bestvideo',
        ]);

        $dl->setDownloadPath('/home/fabian/Downloads');

        try {
            header('Content-type: video/*');
            header('Content-Disposition: attachment');
            $video = $dl->download('https://www.youtube.com/watch?v=zRwy8gtgJ1A');
            //header('Content-Disposition: attachment');
            //dd ($video->getTitle()); // Will return Phonebloks
            // $video->getFile(); // \SplFileInfo instance of downloaded file
        } catch (NotFoundException $e) {
            // Video not found
            dd('Not Found');
        } catch (PrivateVideoException $e) {
            // Video is private
            dd('Private');
        } catch (CopyrightException $e) {
            // The YouTube account associated with this video has been terminated due to multiple third-party notifications of copyright infringement
            dd('copystriked');
        } catch (\Exception $e) {
            // Failed to download
            dd('Failed');
        }



        $zip = new \ZipArchive();
        $filename = "./test112.zip";

        $zip->open($filename, \ZipArchive::CREATE);

        $zip->close();

        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-length: " . filesize($filename));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile($filename);
*/
        //return back();

    }
}
