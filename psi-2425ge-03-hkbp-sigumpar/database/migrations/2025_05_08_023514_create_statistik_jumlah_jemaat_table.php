<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jumlah_lansia');
            $table->integer('jumlah_bapak');
            $table->integer('jumlah_ibu');
            $table->integer('jumlah_anak');
            $table->integer('jumlah_remaja');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik');
    }
};
