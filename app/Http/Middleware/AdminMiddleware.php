<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session()->get('user');
        if (!$user || $user->role !== 'admin') {
            return redirect('/login');
        }
        return $next($request);
    }
} 