<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiGereja extends Model
{
    use HasFactory;

    protected $table = 'lokasi_gereja';

    protected $fillable = [
        'nama_gereja',
        'embed_url',
    ];
}
