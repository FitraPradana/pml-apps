<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Excel::Xls

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->roles == 'admin') {
                return redirect()->intended('home_admin');
            } elseif ($user->roles == 'user') {
                return redirect()->intended('home_user');
            } elseif ($user->roles == 'vessel') {
                return redirect()->intended('home_crew');
            }
        }

        $getuser = User::all();
        if ($getuser->isEmpty()) {
            $this->import_user_auto();
        }

        return view('login');
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'   => 'Email tidak boleh kosong',
                'password.required'   => 'Password tidak boleh kosong',
            ]
        );

        $kredensial = $request->only('email', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->roles == 'admin') {
                return redirect()->intended('home_admin');
            } elseif ($user->roles == 'user') {
                return redirect()->intended('home_user');
            } elseif ($user->roles == 'vessel') {
                return redirect()->intended('home_crew');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email tidak terdaftar',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function import_user_auto()
    {
        $path = public_path('document/User Import.xlsx');
        $import = (new UserImport);
        $import->import($path);
        // $import = (new UserImport)->import('document/User Import.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('login')->with('success', 'Data User Berhasil di Import AUTOMATIC!!!');
    }
}
