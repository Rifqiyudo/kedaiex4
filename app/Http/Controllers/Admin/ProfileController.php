<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = session('user');
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \App\Models\User::find(session('user')->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();
        // Update session user agar perubahan langsung terlihat
        $request->session()->put('user', $user);
        return redirect()->route('admin.profile')->with('success', 'Profile berhasil diupdate');
    }
}
