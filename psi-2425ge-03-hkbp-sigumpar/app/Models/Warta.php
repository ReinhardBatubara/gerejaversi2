<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    protected $table = 'warta';

    protected $fillable = ['judul', 'file_path'];
}
