<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with([
            'user',
            'archive'
        ])
        ->whereIn('status', [
            'approved',
            'preparing',
            'ready'
        ])
        ->latest()
        ->get();

        return view('staff.borrowings.index', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load([
            'user',
            'archive'
        ]);

        return view('staff.borrowings.show', compact('borrowing'));
    }

    public function prepare(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'approved') {
            return back()->with('error', 'Pengajuan belum dapat diproses.');
        }

        $borrowing->update([
            'status' => 'preparing',
            'prepared_by' => Auth::id(),
            'prepared_at' => now(),
        ]);

        return redirect()
            ->route('staff.borrowings.index')
            ->with('success', 'Arsip sedang disiapkan.');
    }

    public function ready(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'preparing') {
            return back()->with('error', 'Arsip belum dalam proses persiapan.');
        }

        $borrowing->update([
            'status' => 'ready',
        ]);

        return redirect()
            ->route('staff.borrowings.index')
            ->with('success', 'Arsip sudah siap diambil.');
    }

    public function borrowed(Borrowing $borrowing)
{
    if ($borrowing->status !== 'ready') {
        return back()->with('error', 'Arsip belum siap untuk dipinjam.');
    }

    $borrowing->update([
        'status' => 'borrowed',
    ]);

    return redirect()
        ->route('staff.borrowings.index')
        ->with('success', 'Arsip berhasil diserahkan kepada peminjam.');
}
}