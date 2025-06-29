<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LayananGereja;

class CreatePemberitahuanTable extends Migration
{
    public function up()
{
    Schema::create('pemberitahuan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // user penerima notifikasi
        $table->string('judul'); // judul notifikasi
        $table->text('pesan'); // isi pesan notifikasi
        $table->boolean('is_read')->default(false); // status sudah dibaca atau belum
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->index('is_read');
        $table->unsignedBigInteger('layanan_id')->nullable();
        $table->foreign('layanan_id')->references('id')->on('layanangereja')->onDelete('cascade'); // Menambahkan foreign key
    });
}


    public function down()
    {
        // Menghapus tabel pemberitahuan
        Schema::dropIfExists('pemberitahuan');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananGereja::class, 'layanan_id');
    }
}
