<?php

namespace App\Http\Controllers;

class JenisPeminjamanController extends Controller
{
    /**
     * Menampilkan jenis peminjaman.
     */
    public function index()
    {
        $jenisPeminjaman = config(
            'archive.jenis_peminjaman'
        );

        return view(
            'jenis-peminjaman.index',
            compact('jenisPeminjaman')
        );
    }
}