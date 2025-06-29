<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJemaat extends Model
{
    use HasFactory;

    protected $table = 'datajemaat';

    protected $fillable = [
        'jumlah_anak', 
        'jumlah_remaja', 
        'jumlah_dewasa', 
        'jumlah_lansia',  
        'tanggal', 
        'week',
    ];
}
