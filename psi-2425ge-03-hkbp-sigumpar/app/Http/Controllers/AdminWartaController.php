<?php

namespace App\Http\Controllers;

use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWartaController extends Controller
{
    // Menampilkan daftar warta untuk admin
    public function index()
    {
        $warta = Warta::latest()->get();
        $latestWarta = $warta->first();

        return view('admin.warta.index', compact('warta', 'latestWarta'));
    }

    // Menampilkan form tambah warta
    public function create()
    {
        return view('admin.warta.create');
    }

    // Menyimpan data warta jemaat ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $originalName = $request->file('file')->getClientOriginalName();
            $filename = $originalName;
            $filePath = $request->file('file')->storeAs('warta', $filename, 'public');

            Warta::create([
                'judul' => $request->judul,
                'file_path' => $filePath,
                'original_name' => $originalName,
            ]);

            return redirect()->route('admin.warta.index')->with('success', 'Warta berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan atau gagal diunggah.');
    }

    // Mengunduh file warta
    public function download($id)
    {
        $warta = Warta::findOrFail($id);
        $filePath = $warta->file_path;
        $originalName = $warta->original_name;

        if (Storage::disk('public')->exists($filePath)) {
            return response()->download(storage_path('app/public/' . $filePath), $originalName);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    // Menghapus warta dan file dari storage
    public function destroy($id)
    {
        $warta = Warta::findOrFail($id);

        if (Storage::disk('public')->exists($warta->file_path)) {
            Storage::disk('public')->delete($warta->file_path);
        }

        $warta->delete();

        return redirect()->route('admin.warta.index')->with('success', 'Warta berhasil dihapus');
    }

    // Menampilkan daftar warta untuk user
    public function indexUser()
    {
        $wartas = Warta::orderBy('created_at', 'desc')->get();
        $latestWarta = $wartas->first();

        return view('warta.warta', compact('wartas', 'latestWarta'));
    }
}
