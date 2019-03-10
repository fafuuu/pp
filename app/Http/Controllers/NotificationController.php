<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function read()
    {

        $notification_id = request('notification');
        $notification = \Auth::user()->notifications()->find($notification_id);
        $notification->markAsRead();
        
        return back();

    }

    public function delete()
    {

        $notification_id = request('notification');
        $notification = \Auth::user()->notifications()->find($notification_id);
        $notification->delete();
        
        return back();

    }
}
