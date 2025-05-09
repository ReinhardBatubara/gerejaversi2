<?php

// app/Models/JadwalIbadah.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    protected $table = 'jadwal_ibadah';

    protected $fillable = [
        'nama', 'tanggal', 'jam_mulai', 'jam_selesai', 'bahasa',
    ];
}