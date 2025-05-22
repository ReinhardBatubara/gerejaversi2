<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanangerejaTable extends Migration
{
    public function up()
    {
        Schema::create('layanangereja', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // tambahkan ini
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('jenis_layanan'); // contoh: martuppol, naik_sidi, pernikahan, dll
            $table->boolean('status_aktif')->default(true);

            $table->string('nama_jemaat');
            $table->string('alamat')->nullable();
            $table->string('no_telepon')->nullable();

            $table->string('surat_keterangan_warga')->nullable();
            $table->string('surat_baptis')->nullable();
            $table->string('surat_naik_sidi')->nullable();
            $table->string('surat_martuppol')->nullable();
            $table->string('akta')->nullable();
            $table->string('dokumen_pranikah')->nullable();

            $table->string('lingkungan')->nullable();
            $table->date('tanggal_layanan')->nullable();

            $table->text('keterangan')->nullable();
            $table->string('status')->default('menunggu');
            $table->string('wijk')->nullable();

            $table->timestamps();
            
        });

    }

    public function down()
    {
        Schema::table('layanangereja', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
