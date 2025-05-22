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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id(); // Primary key otomatis increment
            
            $table->string('nama', 100)
                  ->comment('Jenis ibadah, misal: Sekolah Minggu, Minggu Pagi, dll.');
            
            $table->date('tanggal')->nullable()
                  ->comment('Tanggal pelaksanaan ibadah, nullable jika tidak perlu');
            
            $table->time('jam_mulai')
                  ->comment('Waktu mulai ibadah');
            
            $table->time('jam_selesai')
                  ->comment('Waktu selesai ibadah');
            
            $table->string('bahasa', 50)->nullable()->default(null)
                  ->comment('Bahasa ibadah, contoh: Bahasa Indonesia, Bahasa Batak Toba');
            
            $table->timestamps();

            // Index unik untuk mencegah jadwal ganda di tanggal dan jenis ibadah yang sama
            $table->unique(['nama', 'tanggal'], 'jadwals_nama_tanggal_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
