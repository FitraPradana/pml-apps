<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $timeoutMinutes = config('session.timeout');

            if ($lastActivity && now()->diffInMinutes($lastActivity) > $timeoutMinutes) {
                Auth::logout();
                return redirect('/login')->with('message', 'Sesi Anda telah berakhir. Silakan masuk kembali.');
            }
            // session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
