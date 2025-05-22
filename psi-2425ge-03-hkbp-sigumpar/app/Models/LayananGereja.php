<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananGereja extends Model
{
    use HasFactory;

    protected $table = 'layanangereja';

    protected $fillable = [
        'jenis_layanan',
        'status_aktif',
        'nama_jemaat',
        'alamat',
        'no_telepon',
        'surat_keterangan_warga',
        'surat_baptis',
        'surat_naik_sidi',
        'surat_martuppol',
        'akta',
        'dokumen_pranikah',
        'lingkungan',
        'tanggal_layanan',
        'keterangan',
        'status',
        'wijk',
    ];
}
