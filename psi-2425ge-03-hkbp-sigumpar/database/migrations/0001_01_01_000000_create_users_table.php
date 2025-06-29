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
    // Membuat tabel 'users'
    Schema::create('users', function (Blueprint $table) {
        $table->id();

        $table->string('name'); // Nama pengguna
        $table->string('email')->unique(); // Email pengguna
        $table->timestamp('email_verified_at')->nullable(); // Tanggal verifikasi email
        $table->string('password'); // Password pengguna
        $table->string('role')->default('user'); // Role pengguna

        $table->string('wa_number')->nullable(); // Nomor WhatsApp pribadi
        $table->string('full_name')->nullable(); // Nama lengkap
        $table->string('father_name')->nullable(); // Nama Ayah
        $table->string('mother_name')->nullable(); // Nama Ibu
        $table->string('location')->nullable();
        $table->string('age')->nullable();

        $table->string('husband_name')->nullable(); // Nama Suami
        $table->string('wife_name')->nullable();    // Nama Istri

        $table->string('husband_location')->nullable(); // Lingkungan suami
        $table->string('wife_location')->nullable(); // Lingkungan istri

        $table->string('husband_age')->nullable(); // Umur suami
        $table->string('wife_age')->nullable();    // Umur istri

        $table->string('husband_wa')->nullable(); // Nomor WA suami
        $table->string('wife_wa')->nullable();    // Nomor WA istri

        $table->string('husband_address')->nullable(); // Alamat jika laki-laki
        $table->string('wife_address')->nullable(); // Alamat jika perempuan

        $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable(); // Jenis kelamin

        $table->string('address')->nullable(); // Alamat umum
        
        $table->rememberToken(); // Token untuk sesi login
        $table->timestamps(); // created_at & updated_at
    });

    // Membuat tabel 'password_reset_tokens'
    Schema::create('password_reset_tokens', function (Blueprint $table) {
        $table->string('email')->primary(); // Email sebagai primary key
        $table->string('token'); // Token reset password
        $table->timestamp('created_at')->nullable(); // Timestamp pembuatan token
    });

    // Membuat tabel 'sessions'
    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->primary(); // ID session
        $table->foreignId('user_id')->nullable()->index(); // Relasi user
        $table->string('ip_address', 45)->nullable(); // IP address user
        $table->text('user_agent')->nullable(); // Browser/device
        $table->longText('payload'); // Data session
        $table->integer('last_activity')->index(); // Aktivitas terakhir
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menurunkan tabel 'users'
        Schema::dropIfExists('users');
        
        // Menurunkan tabel 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');
        
        // Menurunkan tabel 'sessions'
        Schema::dropIfExists('sessions');
    }
};
