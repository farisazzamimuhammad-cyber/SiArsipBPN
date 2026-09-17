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
       Schema::create('borrowings', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->foreignId('archive_id')
        ->constrained('archives')
        ->cascadeOnDelete();

    $table->date('tanggal_pengajuan');

    $table->date('tanggal_peminjaman')->nullable();

    $table->date('tanggal_pengembalian')->nullable();

    $table->text('keperluan');

    $table->string('status')->default('pending');

    $table->foreignId('approved_by')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->timestamp('approved_at')->nullable();

    $table->foreignId('prepared_by')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->timestamp('prepared_at')->nullable();

    $table->text('catatan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
