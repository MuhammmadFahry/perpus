<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Asumsi Anda memiliki model Notification
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Show notifications for the user and admin.
     */
    public function showNotifications()
    {
        // Fetch notifications for the current user
        $userNotifications = Notification::where('user_id', Auth::id())->get();

        // If the user is an admin, also fetch admin notifications
        $adminNotifications = Auth::user()->is_admin
            ? Notification::where('is_for_admin', true)->get()
            : [];

        // Return the notifications view
        return view('notification', compact('userNotifications', 'adminNotifications'));
    }
}
