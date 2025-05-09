<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_ibadah', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)
                  ->comment('Jenis ibadah, misal: Sekolah Minggu, Minggu Pagi, dll.');
            $table->date('tanggal')
                  ->comment('Tanggal pelaksanaan ibadah');
            $table->time('jam_mulai')
                  ->comment('Waktu mulai ibadah');
            $table->time('jam_selesai')
                  ->comment('Waktu selesai ibadah');
            $table->string('bahasa', 50)
                  ->nullable()
                  ->default(null)
                  ->comment('Bahasa ibadah, contoh: Bahasa Indonesia, Bahasa Batak Toba');
            $table->timestamps();

            // Pastikan tidak ada duplikasi jadwal untuk hari dan jenis yang sama
            $table->unique(['nama', 'tanggal'], 'jadwal_ibadah_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadah');
    }
};