<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatMingguanTable extends Migration
{
    public function up()
    {
        Schema::create('jemaat_mingguan', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom lain sesuai kebutuhan, misal:
            // $table->string('nama');
            // $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jemaat_mingguan');
    }
}
