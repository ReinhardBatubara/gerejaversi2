<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{
    public function __construct()
    {
        // Bagikan jumlah notifikasi belum dibaca ke semua view jika user login
        View::composer('*', function ($view) {
            $countUnread = 0;
            if (Auth::check()) {
                $countUnread = Notification::where('user_id', Auth::id())
                                ->where('is_read', false)
                                ->count();
            }
            $view->with('countUnreadNotifications', $countUnread);
        });
    }

    public function index()
    {
        // Ambil notifikasi user yang login
        $notifications = Notification::where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('halaman.pemberitahuan.admin.pemberitahuan', compact('notifications'));
    }

    // Optional: method untuk tandai notifikasi sudah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notification->update(['is_read' => true]);

        return redirect()->back();
    }
}
