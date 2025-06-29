<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananGereja extends Model
{
    use HasFactory;

    protected $table = 'layanangereja';

    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'status_aktif',
        'nama_jemaat',
        'nama_anak',
        'nama_jemaat_laki',
        'nama_jemaat_perempuan',
        'nama_kegiatan',
        'alamat',
        'alamat_laki',
        'alamat_perempuan',
        'no_telepon',
        'no_telepon_laki',
        'no_telepon_perempuan',
        'umur',
        'nama_ayah',
        'nama_ibu',
        'lingkungan',
        'lingkungan_laki',
        'lingkungan_perempuan',
        'tanggal_layanan',
        'surat_keterangan_warga',
        'surat_baptis',
        'surat_baptis_laki',
        'surat_baptis_perempuan',
        'surat_naik_sidi_laki',
        'surat_naik_sidi_perempuan',
        'surat_martuppol',
        'akta',
        'dokumen_pranikah',
        'surat_nikah',
        'kartu_keluarga',
        'akta_lahir',
        'keterangan',
        'status',
        'detail_acara',
        'tanggal_lahir',
        'alasan',
    ];

    public function pemberitahuan()
{
    return $this->hasMany(Pemberitahuan::class, 'jenis_layanan', 'kode');
}

// Di model LayananGereja
public function user()
{
    return $this->belongsTo(User::class);
}


}
