<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        $user = $request->session()->get('user');
        
        if (!$user) {
            return redirect('/login');
        }

        // Jika tidak ada parameter role, berarti hanya cek login saja
        if ($role === null) {
            return $next($request);
        }

        // Cek apakah user memiliki role yang sesuai
        if ($user->role !== $role) {
            // Redirect berdasarkan role user ke halaman yang sesuai
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'pelanggan') {
                return redirect('/pelanggan/produk');
            } elseif ($user->role === 'barista') {
                return redirect('/admin'); // atau halaman barista jika ada
            }
            
            // Jika role tidak dikenal, redirect ke login
            return redirect('/login');
        }

        return $next($request);
    }
} 