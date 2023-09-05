<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        $employees = Employee::all();
        $positions = DB::table('positions')
            ->leftJoin('departments', 'positions.department_id', 'departments.id')
            ->select('positions.*', 'departments.dept_name')
            ->get();
        $users = User::all();
        return view('employee.view', compact('employees', 'positions', 'users'));
    }

    public function json()
    {

        $Employee = DB::table('employees')
            ->leftJoin('users', 'employees.user_id', 'users.id')
            ->leftJoin('positions', 'employees.position_id', 'positions.id')
            ->leftJoin('departments', 'positions.department_id', 'departments.id')
            ->select('employees.*', 'users.full_name', 'departments.dept_name', 'positions.position_name')
            ->orderByDesc('employees.updated_at')
            ->get();

        return DataTables::of($Employee)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                    <a href="#" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset" data-toggle="modal" data-target="#edit_employee' . $data->id . '"><i class="fa fa-pencil"></i></a>
                </div>
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
            DB::commit();
            return redirect('employees')->with(['success' => 'Data Account User/Employee berhasil di Tambahkan !']);
        } catch (\Throwable $th) {
            $empALL = Employee::where('emp_accountnum', $request->emp_accountnum)->first();
            if ($empALL) {
                return redirect('employees')->with('error', 'Data Account "' . $request->emp_accountnum . '" already exists !');
            }
            $empALL = Employee::where('emp_email', $request->emp_email)->first();
            if ($empALL) {
                return redirect('employees')->with('error', 'Data Email "' . $request->emp_email . '" already exists !');
            }

            DB::rollBack();


            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        // Update Data Employees
        $dataEmployee = [
            'emp_name'          => $request->emp_name,
            'emp_phone'         => $request->emp_phone,
            'emp_address'       => $request->emp_address,
            'emp_remarks'       => $request->emp_remarks,
            // 'department_id'     => $request->department_id,
            // 'user_id'           => $request->user_id,
        ];
        Employee::find($id)->update($dataEmployee);

        return redirect('employees')->with(['success' => 'Data Employee "' . $request->emp_name . '" berhasil di Update !']);
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
