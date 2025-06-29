<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'pemberitahuan'; // Pastikan ini sesuai dengan nama tabel di database Anda

    // Menambahkan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'is_read',
        'no_telepon',
        'tanggal_layanan',
        'detail_acara'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function layanan()
    {
        return $this->belongsTo(LayananGereja::class, 'jenis_layanan', 'kode');
    }
}
