<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileGerejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Masukkan data ke dalam tabel profile_gereja
        DB::table('profile_gereja')->insert([
            'sejarah' => 'Dr. Ingwer Ludwig Nommensen adalah misionaris Jerman yang menyebarkan agama Kristen di Tanah Batak dan menjadi ephorus pertama HKBP. Ia lahir pada 6 Februari 1834 di Nordstrand, Jerman, dan wafat di Sigumpar, Toba Samosir, pada 23 Mei 1918. Napak tilas perjalanan Nommensen menjadi bagian dari peringatan Jubileum 150 tahun HKBP. Rombongan napak tilas mengunjungi makam Nommensen di Sigumpar, yang menjadi tujuan wisata rohani. Makamnya dilapisi marmer dengan latar belakang Danau Toba dan berada dalam kompleks bersama keluarga dan rekan-rekan sepelayanan. Meski demikian, akses jalan menuju makam masih kurang memadai. Pemerintah Kabupaten Toba Samosir dan HKBP terus mengelola serta mengembangkan kompleks ini sebagai destinasi wisata rohani. Wisatawan, termasuk keturunan Nommensen dari Jerman, kerap berkunjung untuk menghormati jasanya dalam membebaskan masyarakat Batak dari animisme dan keterbelakangan.',
            'visi' => 'MENJADI BERKAT BAGI DUNIA',
            'misi' => '1. Beribadah kepada Allah Tri Tunggal Bapa, Anak, dan Roh Kudus, dan bersekutu dengan saudara-saudara seiman.
                    2. Mendidik jemaat supaya sungguh-sungguh menjadi anak Allah dan warga negara yang baik.
                    3. Mengabarkan Injil kepada yang belum mengenal Kristus dan yang sudah menjauh dari gereja.
                    4. Mendoakan dan menyampaikan pesan kenabian kepada masyarakat dan Negara.
                    5. Menggarami dan menerangi budaya Batak, Indonesia dan Global dengan Injil.
                    6. Memulihkan harkat dan martabat orang kecil dan tersisih melalui pendidikan, kesehatan, dan pemberdayaan ekonomi masyarakat.
                    7. Membangun dan mengembangkan kerjasama antar gereja dan dialog lintas agama.
                    8. Mengembangkan penatalayanan (pelayan, organisasi, administrasi, keuangan, dan aset) dan melaksanakan pembangunan gereja dan lingkungan hidup.',
            'makam' => 'Makam misionaris agama Kristen asal Jerman, DR I.L Nommensen yang berada di Kompleks Gereja Huria Kristen Batak Protestan (HKBP) I.L Nommensen Sigumpar, Kecamatan Sigumpar, Kabupaten Toba, Provinsi Sumatra Utara kini sering dikunjungi wisatawan. Kunjungan ini sering disebut wisata rohani. Salah seorang pengurus Gereja HKBP Nomensen Pdt. Giovani Siregar, Selasa (28/2/23) di sela-sela memandu wisatawan yang berkunjung, mengatakan DR I.L Nomensen adalah seorang misionaris yang membawa perubahan pola pikir dan kepercayaan yang mendasar bagi masyarakat Batak untuk melangkah keluar dari pola animisme ke arah Agama Kristen bagi orang Batak. DR I.L Nommensen menghembuskan nafas terakhirnya pada usia 84 tahun tepatnya pada tanggal 23 Mei 1918, kemudian beliau dimakamkan di belakang Gereja HKBP Nommensen Sigumpar.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
