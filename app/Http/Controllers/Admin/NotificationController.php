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

        $notification = Auth::user()->notifications->where('id',$request)->first();
        $notification_data = json_decode($notification)->data;
        $product_id = $notification_data->product_id;
        $link = $notification_data->link;
        $notification->markAsRead();
        return redirect(route($link,$product_id));
        // $notification_id, $product_id, $link
    }
}
