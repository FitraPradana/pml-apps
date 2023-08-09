<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    //

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
