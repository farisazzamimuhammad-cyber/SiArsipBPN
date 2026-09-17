<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\User;
use App\Models\Archive;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalArchives = Archive::count();

        $pendingBorrowings = Borrowing::where('status', 'pending')->count();

        $approvedBorrowings = Borrowing::where('status', 'approved')->count();

        $rejectedBorrowings = Borrowing::where('status', 'rejected')->count();

        $borrowedBorrowings = Borrowing::where('status', 'borrowed')->count();

        $returnedBorrowings = Borrowing::where('status', 'returned')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalArchives',
            'pendingBorrowings',
            'approvedBorrowings',
            'rejectedBorrowings',
            'borrowedBorrowings',
            'returnedBorrowings'
        ));
    }
}