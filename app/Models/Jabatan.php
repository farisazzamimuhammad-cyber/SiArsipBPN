<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'parent_id',
        'kelompok',
    ];

    public function parent()
    {
        return $this->belongsTo(Jabatan::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Jabatan::class, 'parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}