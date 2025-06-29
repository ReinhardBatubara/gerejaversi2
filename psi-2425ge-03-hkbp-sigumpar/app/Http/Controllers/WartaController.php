<?php

namespace App\Http\Controllers;

use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class WartaController extends Controller
{
    public function index()
    {
        // Ambil semua warta, urut terbaru dulu
        $user = Auth::user();
        $wartas = Warta::orderBy('created_at', 'desc')->get();
        $warta = Warta::orderBy('created_at', 'desc')->get();

        // Ambil warta terbaru (pertama)
        $latestWarta = $wartas->first();

        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            return view('halaman.wartagereja.user.warta', compact('wartas', 'latestWarta'));
        }

        return view('halaman.wartagereja.admin.warta', compact('warta', 'latestWarta'));
    }


    public function create()
    {
        return view('halaman.wartagereja.admin.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Accept only PDF and Word files
        ]);
        
        DB::transaction(function () use ($request) {
            $data = [];

            // Ambil judul dari input
            $data['judul'] = $request->input('judul');

            // Jika ada file diupload, simpan dan ambil path-nya
            if ($request->hasFile('file_path')) {
                $filePath = $request->file('file_path')->store('wartas', 'public');
                $data['file_path'] = $filePath;
            } else {
                $data['file_path'] = null;
            }

            Warta::create($data);
        });

        return redirect()->route('warta.index');
    }
    public function edit($id)
    {
        // Ambil data warta berdasarkan ID
        $warta = Warta::findOrFail($id);
        // Tampilkan form edit dengan data warta
        // Jika user adalah admin, tampilkan halaman edit
        if (Auth::user()->hasRole('user')) {
            return redirect()->route('warta.index');
        }
        return view('halaman.wartagereja.admin.edit', compact('warta'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        $warta = Warta::findOrFail($id);

        // Update data warta
        $warta->judul = $request->input('judul');

        // Jika ada file diupload, simpan dan ambil path-nya
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('wartas', 'public');
            $warta->file_path = $filePath;
        }

        $warta->save();

        return redirect()->route('warta.index');
    }
    public function destroy($id)
    {
        $warta = Warta::findOrFail($id);
        $warta->delete();

        return redirect()->route('warta.index');
    }
}
