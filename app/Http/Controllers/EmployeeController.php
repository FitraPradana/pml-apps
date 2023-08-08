<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        //
        return view('employee.view');
    }

    public function json()
    {

        $Employee = DB::table('employees')
            ->join('users', 'employees.user_id', 'users.id')
            ->select('employees.*', 'users.full_name')
            ->orderByDesc('employees.updated_at')
            ->get();

        return DataTables::of($Employee)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->addColumn('user_id', function ($data) {
                return $data->full_name;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            //Save Tbl User
            $userSave = User::create([
                'personnel_number'  => $request->emp_accountnum,
                'username'          => $request->emp_accountnum,
                'full_name'         => $request->emp_name,
                'email'             => $request->emp_email,
                'password'          => Hash::make('PML@2023'),
                'type'              => 'employee',
                'roles'             => 'user',
                'remarks_user'      => $request->emp_remarks,
            ]);

            $usr = User::where('personnel_number', $request->emp_accountnum)->first();

            // Save tbl Employee
            $empSave = Employee::create([
                'emp_accountnum'        => $request->emp_accountnum,
                'emp_name'              => $request->emp_name,
                'emp_email'             => $request->emp_email,
                'emp_phone'             => $request->emp_phone,
                'emp_address'           => $request->emp_address,
                'emp_remarks'           => $request->emp_remarks,
                'user_id'               => $usr->id,
                // 'department_id'             => 'user',
            ]);

            return redirect('employees')->with(['success' => 'Data Account user dan Employee berhasil di Tambahkan !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    // public function insert_general()
    // {
    //     $site = Site::where('site_code', '=', 'GNRL')->first();
    //     $room = Room::where('room_code', '=', 'GNRL')->first();
    //     //
    //     Location::create([
    //         'location_code'             => 'GNRL',
    //         'location_name'             => 'General Location',
    //         'location_remarks'          => '',
    //         'site_id'                   => $site['id'],
    //         'room_id'                   => $room->id,
    //     ]);
    // }
}
