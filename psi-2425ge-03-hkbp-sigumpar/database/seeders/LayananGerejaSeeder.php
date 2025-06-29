<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananGereja;
use App\Models\User;

class LayananGerejaSeeder extends Seeder
{
    public function run()
    {
        // Mengambil ID user yang akan digunakan untuk 'user_id' (misalnya admin)
        $adminUser = User::where('role', 'admin')->first(); // Atau tentukan ID user spesifik

        $layanans = [
            ['kode' => 'martuppol', 'nama' => 'Martuppol', 'status_aktif' => false, 'user_id' => $adminUser->id],
            ['kode' => 'naik_sidi', 'nama' => 'Pendaftaran Naik Sidi', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'pernikahan', 'nama' => 'Pendaftaran Pernikahan', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'baptis', 'nama' => 'Pendaftaran Baptis', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'jemaat_sakit', 'nama' => 'Pemberitahuan Jemaat Sakit', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'anak_lahir', 'nama' => 'Pemberitahuan Anak Lahir', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'jemaat_meninggal', 'nama' => 'Pemberitahuan Jemaat Meninggal Dunia', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'kunjungan_makam', 'nama' => 'Pemesanan Kunjungan Makam', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'pemesanan_gedung', 'nama' => 'Pemesanan Gedung', 'status_aktif' => true, 'user_id' => $adminUser->id],
            ['kode' => 'kegiatan_mendatang', 'nama' => 'kegiatan Mendatang', 'status_aktif' => true, 'user_id' => $adminUser->id]

        ];

        foreach ($layanans as $layanan) {
            LayananGereja::create($layanan);
        }
    }
}


