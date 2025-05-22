<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jemaat;
use App\Models\User;

class JemaatController extends Controller
{
    public function daftarjemaat()
    {
        $jemaat = Jemaat::all();
        $users = User::all();

        return view('halaman.daftarjemaat.admin.daftarjemaat', compact('jemaat', 'users'));
    }

    public function storejemaat(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        Jemaat::create($request->only('nama', 'alamat', 'no_hp'));

        return redirect()->route('admin.daftarjemaat')->with('success', 'Jemaat berhasil ditambah');
    }

    public function updatejemaat(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $jemaat = Jemaat::findOrFail($id);
        $jemaat->update($request->only('nama', 'alamat', 'no_hp'));

        return redirect()->route('admin.daftarjemaat')->with('success', 'Jemaat berhasil diperbarui');
    }

    public function destroyjemaat($id)
    {
        $jemaat = Jemaat::findOrFail($id);
        $jemaat->delete();

        return redirect()->route('admin.daftarjemaat')->with('success', 'Jemaat berhasil dihapus');
    }
}
