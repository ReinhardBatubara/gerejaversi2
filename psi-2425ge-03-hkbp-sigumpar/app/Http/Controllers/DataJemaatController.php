<?php
namespace App\Http\Controllers;

use App\Models\DataJemaat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataJemaatController extends Controller
{
    // Menampilkan data jemaat dengan filter tanggal
    public function index(Request $request)
    {
        // $query = DataJemaat::query();
        $query = DataJemaat::orderBy('tanggal');

        // Filter berdasarkan rentang tanggal jika ada
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        } else {
            $currentWeek = Carbon::now()->weekOfYear;
            $query->whereIn('week', [$currentWeek, $currentWeek - 1, $currentWeek - 2, $currentWeek - 3]);
        }

        // Mengambil semua data jemaat tanpa filter tanggal
        $dataJemaat = DataJemaat::orderBy('tanggal')->limit(4)->get();


        // Group by tanggal dan jumlahkan per kategori usia
        $byDate = $dataJemaat->groupBy('tanggal')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        // Kirim data ke view
        if (auth()->user() && auth()->user()->role === 'admin') {
            // Jika pengguna admin, tampilkan view untuk admin
            return view('halaman.datajemaat.admin.index', compact('dataJemaat', 'byDate', 'startDate', 'endDate'));
        } 
        // Jika pengguna biasa, tampilkan view untuk user
        else {
            return view('halaman.datajemaat.user.index', compact('dataJemaat', 'byDate', 'startDate', 'endDate'));
        }
    }

    // Menampilkan form untuk membuat data jemaat
    public function create()
    {
        return view('halaman.datajemaat.admin.create');
    }

    // Menyimpan data jemaat ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'week' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'jumlah_remaja' => 'required|integer',
            'jumlah_dewasa' => 'required|integer',
            'jumlah_lansia' => 'required|integer',
        ]);

         // Periksa apakah tanggal sudah ada dalam database
        if (DataJemaat::where('tanggal', $request->tanggal)->exists()) {
        // Jika tanggal sudah ada, berikan pesan error
        return back()->withErrors(['tanggal' => 'Tanggal ini sudah digunakan. Silakan pilih tanggal yang lain.']);
    }

        // Menentukan minggu berdasarkan tanggal
        $week = Carbon::parse($request->tanggal)->weekOfYear;

        // Menyimpan data jemaat
        DataJemaat::create([
            'tanggal' => $request->tanggal,
            'week' => $week,
            'jumlah_anak' => $request->jumlah_anak,
            'jumlah_remaja' => $request->jumlah_remaja,
            'jumlah_dewasa' => $request->jumlah_dewasa,
            'jumlah_lansia' => $request->jumlah_lansia,
        ]);

        return redirect()->route('datajemaat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data jemaat
    public function edit($id)
    {
        $dataJemaat = DataJemaat::findOrFail($id);
        return view('halaman.datajemaat.admin.edit', compact('dataJemaat'));
    }

    // Memperbarui data jemaat
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'week' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'jumlah_remaja' => 'required|integer',
            'jumlah_dewasa' => 'required|integer',
            'jumlah_lansia' => 'required|integer',
        ]);

        $dataJemaat = DataJemaat::findOrFail($id);
        $dataJemaat->update([
            'tanggal' => $request->tanggal,
            'week' => $request->week,
            'jumlah_anak' => $request->jumlah_anak,
            'jumlah_remaja' => $request->jumlah_remaja,
            'jumlah_dewasa' => $request->jumlah_dewasa,
            'jumlah_lansia' => $request->jumlah_lansia,
        ]);

        return redirect()->route('datajemaat.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data jemaat
    public function destroy($id)
{
    $dataJemaat = DataJemaat::find($id); // Mencari data berdasarkan ID

    if (!$dataJemaat) {
        return redirect()->route('datajemaat.index')->with('error', 'Data tidak ditemukan.');
    }

    $dataJemaat->delete(); // Menghapus data jemaat berdasarkan ID

    return redirect()->route('datajemaat.index')->with('success', 'Data berhasil dihapus.');
}


    // Menampilkan statistik data jemaat per minggu
    public function statistics()
    {
        $data = DataJemaat::select('week', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->orderBy('week')
            ->get();

        $byWeek = $data->groupBy('week')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        return view('halaman.datajemaat.statistics', compact('byWeek'));
    }
}
