<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke halaman sesuai role
        if (session()->has('user')) {
            $user = session()->get('user');
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'pelanggan') {
                return redirect('/pelanggan/produk');
            } elseif ($user->role === 'barista') {
                return redirect('/barista/transaksi');
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            $request->session()->put('user', $user);
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.beranda');
            } elseif ($user->role === 'barista') {
                return redirect('/barista/transaksi');
            } else {
                return redirect('/');
            }
        }
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'pelanggan',
        ]);
        // Setelah register, redirect ke login (tidak auto-login)
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
} 