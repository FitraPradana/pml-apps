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
            ->addColumn('action', function ($data) {
                return '
                ';
                // <div class="form group" align="center">
                //     <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                //     <button type="button" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                // </div>
            })
            ->rawColumns(['action', 'name'])
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
    public function update(Request $request, User $user)
    {
        //
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
