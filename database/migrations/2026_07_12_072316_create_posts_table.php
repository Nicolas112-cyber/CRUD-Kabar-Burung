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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content'); // Isi lengkap berita
            $table->string('gambar')->nullable(); // Untuk menyimpan nama file gambar
            $table->string('publisher'); // Penulis atau penerbit berita
            $table->date('tanggal_kejadian'); // Waktu peristiwa terjadi
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
