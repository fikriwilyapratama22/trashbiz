<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session('user_level') !== 'Admin') {
            return redirect()->route('dashboard-nasabah'); // arahkan ke dashboard nasabah jika level bukan admin
        }
        return $next($request);
    }
}
