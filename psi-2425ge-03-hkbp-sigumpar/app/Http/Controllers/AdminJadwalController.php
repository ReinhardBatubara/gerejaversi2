<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalIbadah;

class AdminJadwalController extends Controller
{
    public function edit()
    {
        $jadwal = JadwalIbadah::orderBy('jam_mulai')->get();
        return view('jadwal.AdminJadwal', compact('jadwal'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'jadwal' => 'required|array',
            'jadwal.*.id' => 'nullable|exists:jadwal_ibadah,id',
            'jadwal.*.nama' => 'required|string|max:255',
            'jadwal.*.tanggal' => 'required|date',
            'jadwal.*.jam_mulai' => 'required|date_format:H:i',
            'jadwal.*.jam_selesai' => 'required|date_format:H:i',
            'jadwal.*.bahasa' => 'nullable|string|max:255',
        ]);

        foreach ($data['jadwal'] as $item) {
            // Validasi agar jam_selesai harus setelah jam_mulai untuk masing-masing entri
            if (strtotime($item['jam_selesai']) <= strtotime($item['jam_mulai'])) {
                return back()->withErrors(['Jadwal ' . $item['nama'] . ': Jam selesai harus setelah jam mulai.'])->withInput();
            }

            JadwalIbadah::updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'nama' => $item['nama'],
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
