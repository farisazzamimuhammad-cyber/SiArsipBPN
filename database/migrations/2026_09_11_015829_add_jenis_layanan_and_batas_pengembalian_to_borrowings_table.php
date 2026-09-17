<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {

            $table->foreignId('jenis_layanan_id')
                ->nullable()
                ->after('archive_id')
                ->constrained('jenis_layanans')
                ->nullOnDelete();

            $table->date('batas_pengembalian')
                ->nullable()
                ->after('tanggal_peminjaman');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {

            $table->dropForeign([
                'jenis_layanan_id'
            ]);

            $table->dropColumn([
                'jenis_layanan_id',
                'batas_pengembalian',
            ]);
        });
    }
};