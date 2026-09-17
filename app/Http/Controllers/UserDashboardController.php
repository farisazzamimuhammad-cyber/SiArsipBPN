<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalBorrowings = Borrowing::where('user_id', $userId)->count();

        $pendingBorrowings = Borrowing::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $approvedBorrowings = Borrowing::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        $borrowedBorrowings = Borrowing::where('user_id', $userId)
            ->where('status', 'borrowed')
            ->count();

        $returnedBorrowings = Borrowing::where('user_id', $userId)
            ->where('status', 'returned')
            ->count();

        return view('user.dashboard', compact(
            'totalBorrowings',
            'pendingBorrowings',
            'approvedBorrowings',
            'borrowedBorrowings',
            'returnedBorrowings'
        ));
    }
}