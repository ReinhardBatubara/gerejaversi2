<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananGereja;
use App\Models\Pemberitahuan;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PemberitahuanController extends Controller
{
    public function index()
    {
        // Ambil data layanan dari database
        $layanans = LayananGereja::query();

        // Cek role user yang sedang login
        $user = auth()->user();

        // Jika pengguna admin, ambil semua layanan
        if ($user && $user->role === 'admin') {
            $layanans = $layanans->whereNotNull('jenis_layanan')->get();
        } 

        else {
        $layanans = $layanans->where(function ($query) use ($user) {
                        $query->where('user_id', $user->id)
                              ->orWhere('user_id', 1);
                    })
                    ->whereNotNull('jenis_layanan')
                    ->get();
    }

        // Jika pengguna admin, tampilkan view untuk admin
        if ($user && $user->role === 'admin') {
            return view('halaman.pemberitahuan.admin.pemberitahuan', compact('layanans'));
        } 
        // Jika pengguna biasa, tampilkan view untuk user
        else {
            return view('halaman.pemberitahuan.user.pemberitahuan', compact('layanans'));
        }
    }

    // Fungsi untuk menghapus layanan
    public function destroy($id)
{
    // Cari layanan berdasarkan id
    $layanan = LayananGereja::findOrFail($id);

    // Cek apakah pengguna admin atau jika pengguna biasa, hanya bisa hapus layanan yang mereka buat
    $user = auth()->user();

    if ($user->role !== 'admin' && $layanan->user_id !== $user->id) {
        // Jika bukan admin dan user_id tidak sesuai, blokir akses
        abort(403, 'Unauthorized action.');
    }

    // Hapus layanan
    $layanan->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Pemberitahuan berhasil dihapus.');
}

//     public function updateStatus(Request $request, $id)
// {
//     // Validasi dasar status
//     $request->validate([
//         'status' => 'required|in:Diterima,Ditolak',
//         'alasan' => 'nullable|string|max:255',
//     ]);

//     $layanan = LayananGereja::findOrFail($id);

//     // Hanya admin yang bisa update
//     if (auth()->user()->role !== 'admin') {
//         abort(403, 'Unauthorized action.');
//     }

//     $status = $request->input('status');
//     $alasan = $request->input('alasan');

//     // Validasi tambahan jika status == 'Ditolak'
//     if ($status === 'Ditolak' && (!$alasan || trim($alasan) === '')) {
//         return redirect()->back()->withErrors(['alasan' => 'Alasan wajib diisi jika status Ditolak.']);
//     }

//     $layanan->status = $status;
//     $layanan->alasan = $status === 'Ditolak' ? $alasan : null;
//     $layanan->save();

//     return redirect()->back()->with('success', 'Status dan alasan berhasil diperbarui.');
// }

public function updateStatus(Request $request, $id)
{
    // Validasi dasar status
    $request->validate([
        'status' => 'required|in:Diterima,Ditolak,Sedang Proses,Selesai',
        'alasan' => 'nullable|string|max:255',
        'file' => 'nullable|mimes:pdf|max:10240',  // Max file 10MB dan hanya PDF
    ]);

    $layanan = LayananGereja::findOrFail($id);

    // Hanya admin yang bisa update
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $status = $request->input('status');
    $alasan = $request->input('alasan');
    $file = $request->file('file'); // Mengambil file yang diunggah

    // Validasi jika status adalah 'Ditolak' atau 'Selesai' dan alasan kosong
    if (($status === 'Ditolak' || $status === 'Selesai') && (!$alasan || trim($alasan) === '')) {
        return redirect()->back()->withErrors(['alasan' => 'Alasan wajib diisi.']);
    }

    // Proses file upload jika status "Selesai"
    if ($status === 'Selesai' && $file) {
        // Unggah file ke storage dan ambil path-nya
        $filePath = $file->store('sertifikat_layanan', 'public');
        $layanan->file_path = $filePath; // Simpan path file di database
    }

    $layanan->status = $status;
    $layanan->alasan = $alasan;
    $layanan->save();

    return redirect()->back()->with('success', 'Status dan alasan berhasil diperbarui.');
}




}
