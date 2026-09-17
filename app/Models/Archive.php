<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Archive extends Model
{
    use HasFactory;

    protected $table = 'archives';

    protected $fillable = [
        'user_id',
        'nomor_berkas',
        'judul',
        'jenis_arsip',
        'tanggal_dokumen',
        'keterangan',
        'nama_file',
        'path_file',
        'mime_type',
        'ukuran_file',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function borrowings()
{
    return $this->hasMany(Borrowing::class);
}
}