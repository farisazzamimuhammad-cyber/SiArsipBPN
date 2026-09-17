<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with([
            'user',
            'archive'
        ])
        ->latest()
        ->get();

        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load([
            'user',
            'archive'
        ]);

        return view('admin.borrowings.show', compact('borrowing'));
    }

    public function approve(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ]);

        $borrowing->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil ditolak.');
    }
}