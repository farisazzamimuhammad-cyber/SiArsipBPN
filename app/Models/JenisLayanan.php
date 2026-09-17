<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'jangka_peminjaman',
    ];
}