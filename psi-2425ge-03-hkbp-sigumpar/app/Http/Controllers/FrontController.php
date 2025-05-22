<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function welcome()
    {
        return view('home.welcome');
    }

    public function profil()
    {
        return view('home.profil');
    }

    // buatlah untuk menampilkan jadlwal
    public function jadwal()
    {
        $jadwal = Jadwal::all();
        return view('home.jadwal', compact('jadwal'));
    }
}
