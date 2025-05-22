<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = ['Laki-laki', 'Perempuan'];
        $data = [
            Jemaat::where('jenis_kelamin', 'Laki-laki')->count(),
            Jemaat::where('jenis_kelamin', 'Perempuan')->count()
        ];

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
