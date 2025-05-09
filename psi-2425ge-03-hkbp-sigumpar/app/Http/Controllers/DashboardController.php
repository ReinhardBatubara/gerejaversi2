<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ibadah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::parse('2025-03-30');

        $latestData = [
            'Sekolah Minggu' => Ibadah::where('jenis_ibadah', 'Sekolah Minggu')->whereDate('tanggal', $today)->sum('jumlah'),
            'Minggu Pagi' => Ibadah::where('jenis_ibadah', 'Minggu Pagi')->whereDate('tanggal', $today)->sum('jumlah'),
            'Minggu Siang' => Ibadah::where('jenis_ibadah', 'Minggu Siang')->whereDate('tanggal', $today)->sum('jumlah'),
            'Minggu Sore' => Ibadah::where('jenis_ibadah', 'Minggu Sore')->whereDate('tanggal', $today)->sum('jumlah'),
        ];

        // Buat data statistik 7 minggu terakhir
        $sevenWeeks = collect();
        for ($i = 6; $i >= 0; $i--) {
            $sevenWeeks->push($today->copy()->subWeeks($i)->startOfWeek());
        }

        $jenisIbadah = ['Sekolah Minggu', 'Minggu Pagi', 'Minggu Siang', 'Minggu Sore'];
        $chartData = [];

        foreach ($jenisIbadah as $jenis) {
            $perMinggu = [];
            foreach ($sevenWeeks as $minggu) {
                $jumlah = Ibadah::where('jenis_ibadah', $jenis)
                    ->whereBetween('tanggal', [$minggu, $minggu->copy()->endOfWeek()])
                    ->sum('jumlah');
                $perMinggu[] = $jumlah;
            }
            $chartData[$jenis] = $perMinggu;
        }

        $tanggalLabel = $sevenWeeks->map(fn($tgl) => $tgl->format('d M'))->toArray();

        return view('dashboard', compact('latestData', 'chartData', 'tanggalLabel'));
    }
}
