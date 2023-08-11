<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->import_user_auto();

        return view('user.user_view', [
            'user' => User::all()
        ]);
    }

    public function json()
    {

        $user = User::orderBy('updated_at', 'desc')->get();

        // return Datatables::of(User::all())
        return Datatables::of($user)
            ->editColumn('name', function ($edit_name) {
                return '
                <h2 class="table-avatar">
                    <a href="" class="avatar"><img src="assets/img/people.png" alt=""></a>
                    <a href="">' . $edit_name->full_name . ' <span> ' . $edit_name->personnel_number . '</span></a>
                </h2>
            ';
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->editColumn('type', function ($edit_status) {
                if ($edit_status->type == 'employee') {
                    return '<span class="badge bg-inverse-warning">EMPLOYEE</span>';
                } elseif ($edit_status->type == 'vessel') {
                    return '<span class="badge bg-inverse-info">VESSEL</span>';
                }
            })
            ->editColumn('roles', function ($edit_status) {
                if ($edit_status->roles == 'user') {
                    return '<span class="badge bg-inverse-warning">USER</span>';
                } elseif ($edit_status->roles == 'vessel') {
                    return '<span class="badge bg-inverse-info">VESSEL</span>';
                } elseif ($edit_status->roles == 'admin') {
                    return '<span class="badge bg-inverse-success">ADMIN</span>';
                }
            })
            ->editColumn('active', function ($edit_status) {
                if ($edit_status->active == 'yes') {
                    return '<span class="badge bg-inverse-success">ACTIVE</span>';
                } elseif ($edit_status->active == 'no') {
                    return '<span class="badge bg-inverse-danger">NON ACTIVE</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                <div class="dropdown dropdown-action">
					<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_user' . $data->id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#change_password' . $data->id . '"><i class="fa fa-key m-r-5"></i> Change Password</a>
                        </div>
                </div>
                            ';
                // <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
            })
            ->rawColumns(['action', 'name', 'active', 'type', 'roles'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $UserSave = User::create([
            'personnel_number'          => $request->personnel_number,
            'username'                  => $request->username,
            'full_name'                 => $request->full_name,
            'email'                     => $request->email,
            'password'                  => Hash::make('PML@2023'),
            // 'gender'                    => $request->gender,
            'type'                      => $request->type,
            'roles'                     => $request->roles,
            'remarks_user'              => $request->remarks_user,
        ]);
        $lastInsertid_User = $UserSave->id;

        return redirect('users')->with(['success' => 'Berhasil menambahkan user !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        // Update Data Users
        $dataUser = [
            'username'          => $request->username,
            'full_name'         => $request->full_name,
            'roles'             => $request->roles,
            'remarks_user'      => $request->remarks_user,
            'active'            => $request->active,
        ];
        User::find($id)->update($dataUser);

        return redirect('users')->with(['success' => 'Data User "' . $request->full_name . '" berhasil di Update !']);
    }

    public function change_password(Request $request, User $user, $id)
    {
        // Update Data Fixed Assets
        $dataUser = [
            'password'          => Hash::make($request->password),
        ];
        User::find($id)->update($dataUser);

        return redirect('users')->with(['success' => 'Password User "' . $request->email . '" has been change !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new UserImport();
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/users')->with('success', 'Data User Berhasil di Import !!!');
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');

        // $export = new Excel();
        // return $export->download(new UserExport, 'users.xlsx');
    }

    public function import_user_no_auth()
    {
        return view('import_user_no_auth');
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
