<?php

namespace App\Http\Controllers;

use App\Models\FixedAssets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        // var_dump('test');
        return view('dashboard.home_admin');
    }

    public function home_admin()
    {
        return view('dashboard.home_admin');
    }

    public function home_staff()
    {
        return view('dashboard.home_staff');
    }

    public function home_crew()
    {
        $session_login = Auth::user()->username;

        $asset = FixedAssets::where('vessel_id', '=', $session_login)->get();
        // $user = User::where('username', '=', $session_login)->get();
        $user = User::orderBy('updated_at', 'desc')->get();

        return view('dashboard.home_crew', compact('asset','user'));

    }
}