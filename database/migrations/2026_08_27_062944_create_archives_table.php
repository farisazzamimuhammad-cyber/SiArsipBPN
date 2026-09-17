<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();

            // User yang mengupload arsip
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Informasi arsip
            $table->string('nomor_berkas')->unique();
            $table->string('judul');
            $table->string('jenis_arsip');
            $table->date('tanggal_dokumen');
            $table->text('keterangan')->nullable();

            // Informasi file
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('ukuran_file')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};