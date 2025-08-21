<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Event merepresentasikan sebuah acara atau pengumuman di dalam database.
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Event extends Model
{
    use HasFactory; // Menambahkan trait ini adalah praktik standar di Laravel.

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];
}
