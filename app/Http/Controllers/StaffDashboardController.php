<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $approvedBorrowings = Borrowing::where('status', 'approved')->count();

        $preparingBorrowings = Borrowing::where('status', 'preparing')->count();

        $readyBorrowings = Borrowing::where('status', 'ready')->count();

        $borrowedBorrowings = Borrowing::where('status', 'borrowed')->count();

        $returnedBorrowings = Borrowing::where('status', 'returned')->count();

        return view('staff.dashboard', compact(
            'approvedBorrowings',
            'preparingBorrowings',
            'readyBorrowings',
            'borrowedBorrowings',
            'returnedBorrowings'
        ));
    }
}