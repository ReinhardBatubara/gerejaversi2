<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJemaat extends Model
{
    use HasFactory;

    protected $table = 'datajemaat';

    protected $fillable = [
        'jumlah',
        'jeniskelamin',
        'kategori_usia',
        'tanggal',
    ];
}
