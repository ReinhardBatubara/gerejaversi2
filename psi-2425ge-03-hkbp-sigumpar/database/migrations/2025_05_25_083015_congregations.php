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
        Schema::create('congregations', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_anak')->default(0);  // Kolom untuk jumlah anak-anak
            $table->integer('jumlah_remaja')->default(0);  // Kolom untuk jumlah remaja
            $table->integer('jumlah_dewasa')->default(0);  // Kolom untuk jumlah dewasa
            $table->integer('jumlah_lansia')->default(0);  // Kolom untuk jumlah lansia
            $table->date('tanggal');
            $table->integer('week'); // Menambahkan kolom week
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congregations');
    }
};

