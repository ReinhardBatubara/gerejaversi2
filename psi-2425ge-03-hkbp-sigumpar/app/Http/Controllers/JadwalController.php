<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    // Tampilkan semua jadwal
    public function index()
    {
        $jadwals = Jadwal::all();

        if (!(auth()->user()->hasRole('admin'))) {
            return view('halaman.jadwalgereja.user.jadwal', compact('jadwals'));
        }

        return view('halaman.jadwalgereja.admin.jadwal', compact('jadwals'));
    }

    // Tampilkan form tambah jadwal
    public function create()
    {
        return view('halaman.jadwalgereja.admin.create');
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'pukul' => 'required',
            'deskripsi' => 'required',
        ]);

        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Tampilkan form edit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('halaman.jadwalgereja.admin.edit', compact('jadwal'));
    }


    // Update jadwal
    public function update(Request $request, $id)
    {
        $request->validate([
            'pukul' => 'required',
            'deskripsi' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

   public function massUpdate(Request $request)
{
    $request->validate([
        'jadwal' => 'required|array',
        'jadwal.*.id' => 'required|exists:jadwals,id',
        'jadwal.*.jam_mulai' => 'required|date_format:H:i',
        'jadwal.*.jam_selesai' => 'required|date_format:H:i',
        'jadwal.*.bahasa' => 'required|string',
    ]);

    foreach ($request->jadwal as $data) {
        $jadwal = Jadwal::find($data['id']);
        if ($jadwal) {
            $jadwal->update([
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
                'bahasa' => $data['bahasa'],
            ]);
        }
    }

    return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
}



}
