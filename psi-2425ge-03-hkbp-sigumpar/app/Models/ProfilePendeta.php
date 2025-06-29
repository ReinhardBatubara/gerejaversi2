<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePendeta extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel akan otomatis cari 'pastor_profiles')
    protected $table = 'profile_pendeta';

    // Kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'nama',
        'posisi',
        'deskripsi',
        'photo_url',
    ];
}
