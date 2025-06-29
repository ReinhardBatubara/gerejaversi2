<?php

namespace Database\Seeders;

use App\Models\ProfilePendeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePendetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilePendeta::create([
        'nama' => 'Pdt. Jonni D.S.Tambun, S.Th',
        'posisi' => 'Kepala Pendeta Gereja HKBP DR. IL. Nommensen Sigumpar',
        'deskripsi' => 'Pdt. Jonni D.S.Tambun, S.Th adalah seorang pendeta berpengalaman yang memimpin komunitas dengan penuh kasih dan dedikasi. Beliau aktif dalam pelayanan rohani dan pengembangan gereja serta keterlibatan sosial masyarakat.',
        'photo_url' => '/images/Pendeta.jpg',
    ]);
    }
}
