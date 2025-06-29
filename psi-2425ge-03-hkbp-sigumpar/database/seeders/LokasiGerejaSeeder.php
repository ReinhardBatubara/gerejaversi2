<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LokasiGereja;

class LokasiGerejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokasiGereja::create([
        'nama_gereja' => 'Gereja HKBP DR. IL. Nommensen Sigumpar',
        'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.189042659229!2d99.15482971526766!3d2.3948522523934147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0059f78cc793%3A0x37e26becd0b5a454!2sGereja%20HKBP%20DR.%20IL.%20Nommensen%20Sigumpar!5e0!3m2!1sid!2sid!4v1684417912345!5m2!1sid!2sid',
    ]);
    }
}
