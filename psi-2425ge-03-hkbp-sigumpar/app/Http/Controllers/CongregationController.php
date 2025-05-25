<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CongregationController extends Controller
{
    // Menampilkan data berdasarkan minggu
    public function index(Request $request)
    {
        // Ambil minggu yang berjalan
        $currentWeek = Carbon::now()->weekOfYear;

        // Ambil data berdasarkan minggu ini dan 3 minggu sebelumnya
        $congregations = Congregation::whereIn('week', [$currentWeek, $currentWeek - 1, $currentWeek - 2, $currentWeek - 3])
            ->orderBy('week')
            ->get();

        // Statistik untuk chart (data jumlah per kategori usia, tanpa penjumlahan total)
        $data = Congregation::select('week', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->orderBy('week')
            ->get();

        // Format data untuk chart berdasarkan minggu
        $byWeek = $data->groupBy('week')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        // Pastikan semua variabel yang dibutuhkan dikirim ke view
        return view('halaman.congregation.index', compact('congregations', 'byWeek'));
    }

    // Menampilkan form untuk menambahkan data jemaat
    public function create()
    {
        // Ambil data untuk statistik chart (hanya berdasarkan minggu dan jumlah kategori usia)
        $data = Congregation::select('week', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->orderBy('week')
            ->get();

        // Format data untuk chart
        $byWeek = $data->groupBy('week')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        // Kirim data ke view
        return view('halaman.congregation.create', compact('byWeek'));
    }

    // Menyimpan data ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'week' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'jumlah_remaja' => 'required|integer',
            'jumlah_dewasa' => 'required|integer',
            'jumlah_lansia' => 'required|integer',
        ]);

        // Menghitung minggu berdasarkan tanggal
        $week = Carbon::parse($request->tanggal)->weekOfYear;

        // Simpan data jemaat untuk setiap kategori usia
        Congregation::create([
            'tanggal' => $request->tanggal,
            'week' => $week,
            'jumlah_anak' => $request->jumlah_anak,
            'jumlah_remaja' => $request->jumlah_remaja,
            'jumlah_dewasa' => $request->jumlah_dewasa,
            'jumlah_lansia' => $request->jumlah_lansia,
        ]);

        return redirect()->route('congregations.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data jemaat
    public function edit($id)
    {
        $congregation = Congregation::findOrFail($id);

        // Ambil data untuk statistik chart (hanya berdasarkan minggu dan jumlah kategori usia)
        $data = Congregation::select('week', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->orderBy('week')
            ->get();

        // Format data untuk chart
        $byWeek = $data->groupBy('week')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        // Kirim data ke view
        return view('halaman.congregation.edit', compact('congregation', 'byWeek'));
    }

    // Memperbarui data yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'week' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'jumlah_remaja' => 'required|integer',
            'jumlah_dewasa' => 'required|integer',
            'jumlah_lansia' => 'required|integer',
        ]);

        // Menghitung minggu berdasarkan tanggal
        $week = Carbon::parse($request->tanggal)->weekOfYear;

        // Temukan data jemaat berdasarkan ID dan perbarui
        $congregation = Congregation::findOrFail($id);
        $congregation->update([
            'tanggal' => $request->tanggal,
            'week' => $week,
            'jumlah_anak' => $request->jumlah_anak,
            'jumlah_remaja' => $request->jumlah_remaja,
            'jumlah_dewasa' => $request->jumlah_dewasa,
            'jumlah_lansia' => $request->jumlah_lansia,
        ]);

        return redirect()->route('congregations.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data dari database
    public function destroy(Congregation $congregation)
    {
        $congregation->delete();
        return redirect()->route('congregations.index')->with('success', 'Data berhasil dihapus.');
    }

    // Menampilkan statistik dalam bentuk diagram (charts)
    public function statistics()
    {
        $data = Congregation::select('week', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->orderBy('week')
            ->get();

        // Format data untuk chart
        $byWeek = $data->groupBy('week')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        return view('halaman.congregation.statistics', compact('byWeek'));
    }

    // Menampilkan data berdasarkan filter tanggal
    public function filterByDate(Request $request)
    {
        $query = Congregation::query();

        if ($request->has('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $congregations = $query->get();

        // Statistik untuk chart
        $data = Congregation::select('tanggal', 'jumlah_anak', 'jumlah_remaja', 'jumlah_dewasa', 'jumlah_lansia')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $byDate = $data->groupBy('tanggal')->map(function ($group) {
            return [
                'anak' => $group->sum('jumlah_anak'),
                'remaja' => $group->sum('jumlah_remaja'),
                'dewasa' => $group->sum('jumlah_dewasa'),
                'lansia' => $group->sum('jumlah_lansia'),
            ];
        });

        return view('halaman.congregation.index', compact('congregations', 'byDate'));
    }
}
