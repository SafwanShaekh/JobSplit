<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark all unread notifications for the authenticated user as read.
     */
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->noContent();
    }
}