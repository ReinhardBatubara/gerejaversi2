<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservasi.index'); // tampilan daftar jenis reservasi
    }

    public function adminindex()
    {
        return view('reservasi.admin.index'); // tampilan daftar jenis reservasi
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reservasi::create($request->all());
        return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservasi $reservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservasi $reservasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        //
    }

    public function form($jenis)
    {
        $jenis = strtolower($jenis);

        // Validasi jenis reservasi yang tersedia
        $allowed = ['jemaatbaru','anaklahir','baptisan','sidi','meninggal', 'pranikah', 'pernikahan', 'jemaatsakit', 'pindahjemaat', 'kunjunganmakam'];
        if (!in_array($jenis, $allowed)) {
            abort(404);
        }

        return view('reservasi.form', compact('jenis'));
    }

    public function showForm($jenis)
    {
        $jenisValid = ['jemaatbaru','anaklahir','baptisan','sidi','meninggal', 'pranikah', 'pernikahan', 'jemaatsakit', 'pindahjemaat', 'kunjunganmakam'];

        if (!in_array($jenis, $jenisValid)) {
            abort(404);
        }

        return view('reservasi.form', compact('jenis'));
    }

}
