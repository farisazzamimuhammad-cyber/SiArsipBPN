<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'archive_id',

        'jenis_layanan_id',

        'jenis_peminjaman',

        'tanggal_pengajuan',

        'tanggal_peminjaman',

        'batas_pengembalian',

        'tanggal_pengembalian',

        'keperluan',

        'status',

        'approved_by',

        'approved_at',

        'prepared_by',

        'prepared_at',

        'catatan',

    ];


    protected $casts = [

        'tanggal_pengajuan' => 'date',

        'tanggal_peminjaman' => 'date',

        'batas_pengembalian' => 'date',

        'tanggal_pengembalian' => 'date',

        'approved_at' => 'datetime',

        'prepared_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Relasi Pemohon
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi Arsip
    |--------------------------------------------------------------------------
    */

    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi Jenis Layanan
    |--------------------------------------------------------------------------
    */

    public function jenisLayanan()
    {
        return $this->belongsTo(
            JenisLayanan::class,
            'jenis_layanan_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi Kepala Kantor
    |--------------------------------------------------------------------------
    */

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi Petugas
    |--------------------------------------------------------------------------
    */

    public function preparer()
    {
        return $this->belongsTo(
            User::class,
            'prepared_by'
        );
    }

    public function getPetugasRoleAttribute(): ?string
{
    return match ($this->jenis_peminjaman) {

        'buku_tanah' => 'petugasbt',

        'surat_ukur',
        'gambar_ukur' => 'petugassu',

        'warkah' => 'petugaswarkah',

        default => null,
    };
}
}