<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Belum login
        if (! $request->user()) {
            // kalau rutenya punya nama login, pakai itu
            return redirect()->route('login');
        }

        // Sudah login tapi bukan admin/superadmin
        if (! in_array($request->user()->role, ['admin', 'superadmin'], true)) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
