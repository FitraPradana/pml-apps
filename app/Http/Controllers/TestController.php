<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function update_userid_employee()
    {
        $user = User::all();
        foreach ($user as $key => $value) {
            $employee = Employee::where('emp_accountnum', $value->personnel_number);

            $employee->update([
                'user_id' => $value->id,
            ]);
        }

        return redirect('employees')->with(['success' => 'Berhasil update user_id !']);
    }

    // public function store(Request $request)
    // {
    //     //
    //     $image = $request->image;

    //     list($type, $image) = explode(';', $image);
    //     list(, $image)      = explode(',', $image);

    //     $image = base64_decode($image);
    //     $image_name = time() . '.png';
    //     $path = public_path('assets/img/testing/' . $image_name);

    //     file_put_contents($path, $image);

    //     return response()->json(['status' => true]);
    // }
}
