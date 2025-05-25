<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanangerejaTable extends Migration
{
    // database/migrations/2025_05_19_101421_create_layanangereja_table.php

    public function up()
    {
        Schema::create('layanangereja', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('jenis_layanan');
            $table->boolean('status_aktif')->default(true); // kontrol layanan tersedia/tidak

            // Data umum / tambahan sesuai kebutuhan:
            $table->string('nama_jemaat')->nullable(); 
            $table->string('nama_jemaat_laki')->nullable();
            $table->string('nama_jemaat_perempuan')->nullable();

            $table->string('alamat')->nullable();
            $table->string('alamat_laki')->nullable();
            $table->string('alamat_perempuan')->nullable();

            $table->string('no_telepon')->nullable();
            $table->string('no_telepon_laki')->nullable();
            $table->string('no_telepon_perempuan')->nullable();

            $table->string('umur')->nullable();

            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();

            $table->string('lingkungan')->nullable();
            $table->string('lingkungan_laki')->nullable();
            $table->string('lingkungan_perempuan')->nullable();

            $table->date('tanggal_layanan')->nullable();

            // Dokumen file
            $table->string('surat_keterangan_warga')->nullable();
            $table->string('surat_baptis_laki')->nullable();
            $table->string('surat_baptis_perempuan')->nullable();
            $table->string('surat_naik_sidi_laki')->nullable();
            $table->string('surat_naik_sidi_perempuan')->nullable();
            $table->string('surat_martuppol')->nullable();
            $table->string('akta')->nullable();
            $table->string('dokumen_pranikah')->nullable();
            $table->string('surat_nikah')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('akta_lahir')->nullable();

            $table->text('keterangan')->nullable();
            $table->string('status')->default('menunggu');
            $table->string('wijk')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanangereja');
    }

}
