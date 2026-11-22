<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Fungsi memproses form login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email & password cocok
        if (Auth::attempt($credentials, $request->has('remember-me'))) {
            $request->session()->regenerate();

            // Cek Role untuk Redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/petugas/dashboard');
            }
        }

        // Kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah bang!',
        ])->onlyInput('email');
    }

    // Fungsi Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}