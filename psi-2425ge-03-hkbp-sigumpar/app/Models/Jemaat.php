<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'jemaats';

    protected $fillable = ['nama', 'alamat', 'no_hp'];
}
