<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalIbadah;

class AdminJadwalController extends Controller
{
    public function edit()
    {
        // Ambil semua jadwal, dikelompokkan berdasarkan nama ibadah
        $jadwal = JadwalIbadah::orderBy('jam_mulai')->get()->keyBy('nama');
        return view('jadwal.AdminJadwal', compact('jadwal'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'jadwal' => 'required|array',
            'jadwal.*.nama' => 'required|string|max:255',
            'jadwal.*.tanggal' => 'required|date',
            'jadwal.*.jam_mulai' => 'required|date_format:H:i',
            'jadwal.*.jam_selesai' => 'required|date_format:H:i',
            'jadwal.*.bahasa' => 'nullable|string|max:255',
        ]);

        foreach ($data['jadwal'] as $item) {
            if (strtotime($item['jam_selesai']) <= strtotime($item['jam_mulai'])) {
                return back()->withErrors(['Jam selesai harus setelah jam mulai untuk ' . $item['nama']])->withInput();
            }

            JadwalIbadah::updateOrCreate(
                // ['nama' => $item['nama']],
                ['nama' => $item['nama'], 'tanggal' => $item['tanggal']],
                // Cari berdasarkan nama saja, bukan id
                [
                    'tanggal' => $item['tanggal'],
                    'jam_mulai' => $item['jam_mulai'],
                    'jam_selesai' => $item['jam_selesai'],
                    'bahasa' => $item['bahasa'] ?? null,
                ]
            );
        }

        return redirect()->route('jadwal.edit')->with('success', 'Jadwal berhasil diperbarui.');
    }
}
