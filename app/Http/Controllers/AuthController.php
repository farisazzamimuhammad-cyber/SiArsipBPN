<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Admin / Pimpinan
            if ($user->hasRole('Admin')) {
    return redirect()->route('admin.borrowings.index');
}

            // Staff
            if ($user->hasRole('Staff')) {
                return redirect()->route('staff.borrowings.index');
            }

            // User
            if ($user->hasRole('User')) {
                return redirect()->route('user.borrowings.index');
            }

            // Jika belum mempunyai role
            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akun belum memiliki role.',
                ]);
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}