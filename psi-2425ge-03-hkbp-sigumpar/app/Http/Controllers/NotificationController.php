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
        // Ambil notifikasi user yang login (admin, jemaat, dll)
        $notifications = Notification::with('layanan')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

    if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            return view('halaman.pemberitahuan.user.pemberitahuan', compact('notifications'));
        }

        return view('halaman.pemberitahuan.admin.pemberitahuan', compact('notifications'));
    
    }

    // Tandai notifikasi sudah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        $notification->update(['is_read' => true]);

        return redirect()->back();
    }

    // Optional: tandai semua notifikasi sudah dibaca
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back();
    }


    public function destroy($id)
{
    // Cari notifikasi berdasarkan id
    $notification = Notification::findOrFail($id);

    // Pastikan hanya admin yang bisa hapus, atau cek user permission lain jika perlu
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $notification->delete();

    return redirect()->back()->with('success', 'Pemberitahuan berhasil dihapus.');
}

}
