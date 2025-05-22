<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CongregationController extends Controller
{
    // public function index()
    // {
    //     $congregations = Congregation::all();
    //     return view('admin.congregation.index', compact('congregations'));
    // }
    public function index(Request $request)
    {
        $query = Congregation::query();

        if ($request->has('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $congregations = $query->get();
        return view('halaman.congregation.index', compact('congregations'));
    }


    public function create()
    {
        return view('halaman.congregation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'gender' => 'required|string',
            'age_categories' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Congregation::create($request->all());
        $congregations = Congregation::all();
        return view('halaman.congregation.index', compact('congregations'));
        // return redirect()->route('congregation.index')->with('success', 'Data added successfully.');
    }

    public function show(Congregation $congregation)
    {
        return view('halaman.congregation.index', compact('congregation'));
    }


    public function edit($id)
    {
        $congregation = Congregation::findOrFail($id);
        return view('halaman.congregation.edit', compact('congregation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'age_categories' => 'required|in:Anak-anak,Remaja,Dewasa,Lansia',
        ]);

        $congregation = Congregation::findOrFail($id);
        $congregation->update($request->all());

        return redirect()->route('congregations.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy(Congregation $congregation)
    {
        $congregation->delete();
        return redirect()->route('congregations.index')->with('success', 'Data deleted successfully.');
    }

    // Menampilkan statistik dalam bentuk diagram
    public function statistics()
    {
        $data = Congregation::select('tanggal', 'gender', 'age_categories', DB::raw('SUM(jumlah) as total'))
            ->groupBy('tanggal', 'gender', 'age_categories')
            ->orderBy('tanggal')
            ->get();

        // Format data for charts
        $byDate = $data->groupBy('tanggal')->map->sum('total');
        $byGender = $data->groupBy('gender')->map->sum('total');
        $byAge = $data->groupBy('age_categories')->map->sum('total');

        return view('halaman.congregation.statistics', compact('byDate', 'byGender', 'byAge'));
    }
}
