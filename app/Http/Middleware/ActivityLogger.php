<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActivityLogger
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'petugas') {
            $user = Auth::user();
            $user->last_activity = Carbon::now();
            $user->save();
        }

        return $next($request);
    }
}

