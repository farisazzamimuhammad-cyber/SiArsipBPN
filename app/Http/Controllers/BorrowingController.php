<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('archive')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.borrowings.index', compact('borrowings'));
    }

    public function create()
{
    $archives = \App\Models\Archive::orderBy(
        'nomor_berkas'
    )->get();

    $jenisLayanans = \App\Models\JenisLayanan::orderBy(
        'nama'
    )->get();

    $jenisPeminjaman = config(
        'archive.jenis_peminjaman'
    );

    return view(
        'borrowings.create',
        compact(
            'archives',
            'jenisLayanans',
            'jenisPeminjaman'
        )
    );
}

    public function store(Request $request)
{
    $request->validate([

        'archive_id' =>
            'required|exists:archives,id',

        'jenis_layanan_id' =>
            'required|exists:jenis_layanans,id',

        'jenis_peminjaman' =>
            'required|in:buku_tanah,surat_ukur,gambar_ukur,warkah',

        'tanggal_peminjaman' =>
            'required|date|after_or_equal:today',

        'keperluan' =>
            'required|string',

    ]);


    $jenisLayanan = \App\Models\JenisLayanan::findOrFail(
        $request->jenis_layanan_id
    );


    /*
    |--------------------------------------------------------------------------
    | Hitung batas pengembalian
    |--------------------------------------------------------------------------
    */

    $tanggalPeminjaman = \Carbon\Carbon::parse(
        $request->tanggal_peminjaman
    );

    $batasPengembalian = $tanggalPeminjaman->copy()
        ->addDays($jenisLayanan->jangka_peminjaman);


    /*
    |--------------------------------------------------------------------------
    | Simpan peminjaman
    |--------------------------------------------------------------------------
    */

    \App\Models\Borrowing::create([

        'user_id' => auth()->id(),

        'archive_id' => $request->archive_id,

        'jenis_layanan_id' =>
            $request->jenis_layanan_id,

        'jenis_peminjaman' =>
            $request->jenis_peminjaman,

        'tanggal_pengajuan' =>
            now()->toDateString(),

        'tanggal_peminjaman' =>
            $request->tanggal_peminjaman,

        'batas_pengembalian' =>
            $batasPengembalian->toDateString(),

        'keperluan' =>
            $request->keperluan,

        'status' =>
            'pending',

    ]);


    return redirect()
        ->route('user.borrowings.index')
        ->with(
            'success',
            'Pengajuan peminjaman berhasil dibuat.'
        );
}

public function show(Borrowing $borrowing)
{
    $borrowing->load([
        'archive',
        'jenisLayanan',
        'user.jabatan',
        'approver',
        'preparer',
    ]);

    // Pastikan user hanya bisa melihat peminjamannya sendiri
    if ($borrowing->user_id !== auth()->id()) {
        abort(403);
    }

    return view(
        'borrowings.show',
        compact('borrowing')
    );
}

    public function returnArchive(Borrowing $borrowing)
{
    if ($borrowing->user_id !== Auth::id()) {
        abort(403);
    }

    if ($borrowing->status !== 'borrowed') {
        return back()->with('error', 'Arsip belum dapat dikembalikan.');
    }

    $borrowing->update([
        'status' => 'returned',
        'tanggal_pengembalian' => now()->toDateString(),
    ]);

    return redirect()
        ->route('user.borrowings.index')
        ->with('success', 'Arsip berhasil dikembalikan.');
}
}