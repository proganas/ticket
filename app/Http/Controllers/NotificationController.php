<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->each->markAsRead();
        return back();
    }

}
