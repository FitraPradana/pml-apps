<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->roles == 'admin' or Auth::user()->roles == 'user') {
            $employees = Employee::where('user_id', Auth::user()->id)->first();
            // return $employees;
            return view('profile.employee.index', compact('employees'));
        }
    }
}
