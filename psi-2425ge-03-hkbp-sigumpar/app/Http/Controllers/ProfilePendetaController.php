<?php

namespace App\Http\Controllers;

use App\Models\PastorProfile;
use App\Models\ChurchLocation;
use App\Models\LokasiGereja;
use App\Models\ProfilePendeta;
use Illuminate\Http\Request;

class ProfilePendetaController extends Controller
{
    public function index()
    {
        $profile = ProfilePendeta::first();
        $location = LokasiGereja::first();
        return view('halaman.berandagereja.admin.dashboard', compact('profile', 'location'));
    }

     public function edit()
    {
        $profile = ProfilePendeta::first();
        return view('halaman.berandagereja.admin.edit-profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = ProfilePendeta::first();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // optional foto baru
        ]);

        // Jika upload foto baru
        if ($request->hasFile('photo_url')) {
            $file = $request->file('photo_url');
            $filePath = $file->store('profile_pendeta', 'public');

            // Hapus foto lama jika ada
            if ($profile->photo_url && \Storage::disk('public')->exists($profile->photo_url)) {
                \Storage::disk('public')->delete($profile->photo_url);
            }

            $profile->photo_url = $filePath;
        }

        $profile->nama = $validated['nama'];
        $profile->posisi = $validated['posisi'];
        $profile->deskripsi = $validated['deskripsi'];
        $profile->save();

        return redirect()->route('dashboard')->with('success', 'Profil pendeta berhasil diperbarui.');
    }
}
