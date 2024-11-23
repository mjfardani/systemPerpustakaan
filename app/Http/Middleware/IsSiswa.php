<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'SISWA') {
            return $next($request);
        }

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Tidak memiliki hak akses'], 401);
        } else {
            return redirect('/');
        }
    }
}
