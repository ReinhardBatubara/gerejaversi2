<?php

// App/Models/Congregation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congregation extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_anak', 
        'jumlah_remaja', 
        'jumlah_dewasa', 
        'jumlah_lansia',  
        'tanggal', 
        'week',
    ];
}
