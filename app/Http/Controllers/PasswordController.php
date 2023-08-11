<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (session('success')) {
    //             Alert::success(session('success'));
    //         }

    //         if (session('error')) {
    //             Alert::error(session('error'));
    //         }

    //         return $next($request);
    //     });
    // }

    public function change_password_view()
    {
        return view('password.change_password.index');
    }

    public function change_password_update(Request $request, $id)
    {
        // $user = User::find(Auth::user()->id);
        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        // alert()->success('Title', 'Password successfully changed.');
        // return redirect()->back()
        return redirect()->back()->with('success', 'Password successfully changed.');
    }

    public function index()
    {
        return view('reset_password');
    }

    public function reset_password_save(Request $request)
    {
        $pwd_random = Str::random(10);

        $data["email"] = ["pradanafitrah45@gmail.com"];
        $data["title"] = "Reset Password";
        $data["body"] = "Password berhasil di Reset";
        $data["users"] = User::where('email', $request->email)->first();
        $data["pwd_random"] = Str::random(10);

        Mail::send('emails.reset_password.body', $data, function ($message) use ($data) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);
            // ->attachData($pdf->output(), "BA Status Asset.pdf");
        });

        return $data["pwd_random"];
    }
}
