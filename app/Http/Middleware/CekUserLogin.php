<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // if (!$request->user()->hasRole($roles)) {
        //     return redirect('/');
        // }

        // return $next($request);

        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        // $user = Auth::user();
        // if ($user->roles == $roles) {
        //     return $next($request);
        // }
        // return redirect('login')->with('error', 'Anda tidak mempunyai akses !!!');
    }
}
