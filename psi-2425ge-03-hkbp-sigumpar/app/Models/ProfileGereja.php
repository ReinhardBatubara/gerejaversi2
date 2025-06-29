<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileGereja extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'profile_gereja';

    // Tentukan kolom yang boleh diisi (fillable)
    protected $fillable = [
        'sejarah',
        'visi',
        'misi',
        'makam',
    ];
}
