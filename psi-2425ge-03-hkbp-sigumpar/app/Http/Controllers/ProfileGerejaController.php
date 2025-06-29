<?php

namespace App\Http\Controllers;

use App\Models\ProfileGereja;
use Illuminate\Http\Request;

class ProfileGerejaController extends Controller
{
    // Menampilkan halaman edit profile gereja
    public function edit()
    {
        $profileGereja = ProfileGereja::first(); // Mengambil data pertama (atau satu-satunya jika hanya ada satu record)
        return view('halaman.profilegereja.admin.edit', compact('profileGereja'));
    }

    // Menyimpan data profile gereja baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'makam' => 'required|string',
        ]);

        // Simpan data baru
        ProfileGereja::create($request->all());

        return redirect()->route('profilegereja')->with('success', 'Profile Gereja berhasil disimpan!');
    }

    // Memperbarui data profile gereja
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'makam' => 'required|string',
        ]);

        // Temukan data profile gereja
        $profileGereja = ProfileGereja::findOrFail($id);

        // Update data
        $profileGereja->update($request->all());

        return redirect()->route('profilegereja')->with('success', 'Profile Gereja berhasil diperbarui!');
    }

    // Menampilkan halaman profil gereja
    public function show()
    {
        // Ambil data profile gereja
        $profileGereja = ProfileGereja::first(); // Ambil hanya satu data dari tabel profile_gereja

        // Cek apakah pengguna terautentikasi dan memiliki peran 'admin'
        if (auth()->user() && auth()->user()->role === 'admin') {
            // Jika pengguna admin, tampilkan view untuk admin
            return view('halaman.profilegereja.admin.profilegereja', compact('profileGereja'));
        } 
        // Jika pengguna biasa, tampilkan view untuk user
        else {
            return view('halaman.profilegereja.user.profilegereja', compact('profileGereja'));
        }
    }

}
