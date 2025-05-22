<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartJemaat; // pastikan model ini sesuai dengan nama model kamu
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data jemaat dari database
        $data = ChartJemaat::orderBy('tanggal')->get();

        // Siapkan label tanggal dan masing-masing kategori jumlah jemaat
        $labels = $data->pluck('tanggal')->map(function($tanggal) {
            return Carbon::parse($tanggal)->format('d M');
        });

        return view('admin.dashboard', [
            'labels' => $labels,
            'bapak' => $data->pluck('jumlah_bapak'),
            'ibu' => $data->pluck('jumlah_ibu'),
            'anak' => $data->pluck('jumlah_anak'),
            'remaja' => $data->pluck('jumlah_remaja'),
            'lansia' => $data->pluck('jumlah_lansia'),
        ]);
    }
}
