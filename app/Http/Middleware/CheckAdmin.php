<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah sudah login sebagai admin
        if (!session('is_admin_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}