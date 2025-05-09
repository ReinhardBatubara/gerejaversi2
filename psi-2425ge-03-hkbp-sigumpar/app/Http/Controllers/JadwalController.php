<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalIbadah; // Pastikan ini model yang kamu pakai
use Carbon\Carbon;

class JadwalController extends Controller
{
    /**
     * Tampilkan halaman edit jadwal.
     */
    public function edit()
    {
        $jadwal = JadwalIbadah::all(); 
        return view('jadwal.jadwal', compact('jadwal'));
    }

    /**
     * Proses pembaruan jadwal.
     */
    public function update(Request $request)
    {
        $jadwalData = $request->input('jadwal');

        foreach ($jadwalData as $data) {
            // Update berdasarkan nama (pastikan nama itu unik, ya)
            JadwalIbadah::updateOrCreate(
                ['nama' => $data['nama']], // kunci
                [
                    'tanggal'     => $data['tanggal'] ?? now()->toDateString(),
                    'jam_mulai'   => $data['jam_mulai'],
                    'jam_selesai' => $data['jam_selesai'],
                    'bahasa'      => $data['bahasa'],
                ]
            );
        }

        return redirect()->route('jadwal.edit')->with('success', 'Jadwal berhasil diperbarui!');
    }
}