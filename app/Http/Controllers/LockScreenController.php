<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function lock_screen(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
                return redirect()->intended('/');
            } else {
                return back()->withErrors(['password' => 'Kata sandi salah.']);
            }
        }
        return view('lock-screen');
    }

    public function unlock(Request $request)
    {
        $credentials = $request->only('password');

        if (Auth::attempt($credentials)) {
            session(['lock_screen' => false]);
            return redirect()->intended('/');
        } else {
            return back()->withErrors(['password' => 'Password salah']);
        }
    }
}
