<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // di sini ambil data notifikasi dari database, lalu kirim ke view
        $notifications = auth()->user()->notifications ?? [];
        return view('notifications.index', compact('notifications'));
    }
}
