<?php

namespace App\Http\Controllers;

use App\Models\DataJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatajemaatController extends Controller
{
    public function index(Request $request)
    {
        $query = DataJemaat::query();

        if ($request->has('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $datajemaat = $query->get();
        return view('halaman.datajemaat.index', compact('datajemaat'));
    }

    public function create()
    {
        return view('halaman.datajemaat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
            'kategori_usia' => 'required|in:Anak-anak,Remaja,Dewasa,Lansia',
            'tanggal' => 'required|date',
        ]);

        Datajemaat::create($request->all());
        return redirect()->route('halaman.datajemaat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Datajemaat $datajemaat)
    {
        return view('halaman.datajemaat.index', compact('datajemaat'));
    }

    public function edit($id)
    {
        $datajemaat = Datajemaat::findOrFail($id);
        return view('halaman.datajemaat.edit', compact('datajemaat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
            'kategori_usia' => 'required|in:Anak-anak,Remaja,Dewasa,Lansia',
            'tanggal' => 'required|date',
        ]);

        $datajemaat = Datajemaat::findOrFail($id);
        $datajemaat->update($request->all());

        return redirect()->route('halaman.datajemaat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Datajemaat $datajemaat)
    {
        $datajemaat->delete();
        return redirect()->route('halaman.datajemaat.index')->with('success', 'Data berhasil dihapus.');
    }

    public function statistics()
    {
        $data = Datajemaat::select('tanggal', 'jeniskelamin', 'kategori_usia', DB::raw('SUM(jumlah) as total'))
            ->groupBy('tanggal', 'jeniskelamin', 'kategori_usia')
            ->orderBy('tanggal')
            ->get();

        $byDate = $data->groupBy('tanggal')->map->sum('total');
        $byGender = $data->groupBy('jeniskelamin')->map->sum('total');
        $byAge = $data->groupBy('kategori_usia')->map->sum('total');

        return view('admin.datajemaat.statistics', compact('byDate', 'byGender', 'byAge'));
    }
}
