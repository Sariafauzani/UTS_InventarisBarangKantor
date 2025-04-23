<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function ShowLogin()
    {
        return view('auth.login');
    }

    // Memeriksa kredensial login dan mengatur sesi jika login berhasil
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === '12345') {
            session(['is_admin_logged_in' => true]);
            return redirect('/');
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    // Menghapus sesi login dan mengarahkan pengguna ke halaman login
    public function logout(Request $request)
    {
        // Hapus sesi
        $request->session()->forget('is_admin_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
