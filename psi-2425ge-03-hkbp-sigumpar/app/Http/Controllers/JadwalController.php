<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    // Tampilkan halaman jadwal dengan data dari DB
    public function index()
    {
        $jadwals = Jadwal::all()->map(function ($j) {
            return [
                'id' => $j->id,
                'nama' => $j->nama,
                'jam_mulai' => $j->jam_mulai ? Carbon::parse($j->jam_mulai)->format('H:i') : '',
                'jam_selesai' => $j->jam_selesai ? Carbon::parse($j->jam_selesai)->format('H:i') : '',
                'bahasa' => $j->bahasa,
                'enabled' => true, // kalau ada kolom enabled di DB bisa diambil dari sini
            ];
        });

        // return view('halaman.jadwalgereja.admin.jadwal', compact('jadwals'));
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            return view('halaman.jadwalgereja.user.jadwal', compact('jadwals'));
        }
        return view('halaman.jadwalgereja.admin.jadwal', compact('jadwals'));
    }


    // Update jadwal massal via AJAX (API endpoint)
    public function updateMassal(Request $request)
    {
        $request->validate([
            'jadwals' => 'required|array',
            'jadwals.*.nama' => 'required|string|max:100',
            'jadwals.*.jam_mulai' => 'nullable|date_format:H:i',
            'jadwals.*.jam_selesai' => 'nullable|date_format:H:i',
            'jadwals.*.bahasa' => 'nullable|string|max:50',
            'jadwals.*.enabled' => 'boolean',
            'jadwals.*.id' => 'nullable|integer|exists:jadwals,id',
        ]);

        // Simpan semua jadwal yang diterima
        $inputJadwals = $request->input('jadwals');

        // Ambil semua jadwal saat ini dari DB
        $currentIds = Jadwal::pluck('id')->toArray();

        // Array untuk menandai jadwal yang sudah update
        $updatedIds = [];

        foreach ($inputJadwals as $item) {
            if (!empty($item['id']) && in_array($item['id'], $currentIds)) {
                // Update jadwal existing
                $jadwal = Jadwal::find($item['id']);
                $jadwal->update([
                    'nama' => $item['nama'],
                    'jam_mulai' => $item['jam_mulai'],
                    'jam_selesai' => $item['jam_selesai'],
                    'bahasa' => $item['bahasa'],
                    'enabled' => $item['enabled'] ?? true,
                ]);
                $updatedIds[] = $jadwal->id;
            } else {
                // Buat jadwal baru
                $jadwal = Jadwal::create([
                    'nama' => $item['nama'],
                    'jam_mulai' => $item['jam_mulai'],
                    'jam_selesai' => $item['jam_selesai'],
                    'bahasa' => $item['bahasa'],
                    'enabled' => $item['enabled'] ?? true,
                ]);
                $updatedIds[] = $jadwal->id;
            }
        }

        // Hapus jadwal yang tidak ada di data input
        Jadwal::whereNotIn('id', $updatedIds)->delete();

        return response()->json(['message' => 'Jadwal berhasil diperbarui']);
    }

    public function destroy($id)
{
    $jadwal = Jadwal::find($id);
    
    if (!$jadwal) {
        // Jika jadwal tidak ditemukan, kembalikan response JSON error
        return response()->json(['message' => 'Jadwal tidak ditemukan.'], 404);
    }

    $jadwal->delete();

    // Jika penghapusan berhasil, kembalikan response JSON sukses
    return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
}


}
