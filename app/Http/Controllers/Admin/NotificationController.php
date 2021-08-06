<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function redirection($request)
    {
        // Get Notification
        $notification = Auth::user()->notifications->where('id',$request)->first();

        // Get Notification Data
        $notification_data = json_decode($notification)->data;

        $product_id = $notification_data->product_id;
        $link = $notification_data->link;
        
        // Mark Notification as read
        $notification->markAsRead();

        // Redirect to the link
        return redirect(route($link,$product_id));
    }

    public function markAll()
    {
        // Get Notification
        $notification = Auth::user()->notifications->markAsRead();

        return redirect()->back();
    }
}
