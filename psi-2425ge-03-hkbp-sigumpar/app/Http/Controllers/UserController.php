<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jemaat;

class UserController extends Controller
{
    public function index()
    {
        $data = Jemaat::orderBy('bulan')->get();

        $labels = $data->pluck('bulan');
        $bapak = $data->pluck('bapak');
        $ibu = $data->pluck('ibu');
        $anak = $data->pluck('anak');
        $remaja = $data->pluck('remaja');
        $lansia = $data->pluck('lansia');

        return view('user.beranda', compact('labels', 'bapak', 'ibu', 'anak', 'remaja', 'lansia'));
    }
}
