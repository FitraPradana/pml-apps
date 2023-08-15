<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    //

    public function index()
    {
        //
        return view('department.index');
    }
    public function json()
    {
        $dept = DB::table('departments')
            ->orderByDesc('departments.updated_at')
            ->get();

        return DataTables::of($dept)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                    <a href="#" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset" data-toggle="modal" data-target="#edit_employee' . $data->id . '"><i class="fa fa-pencil"></i></a>
                    <button type="button" onclick="deleteData(`' . route('department.delete', $data->id) . '`)" class="btn btn-xs btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </div>
                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
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
            Department::create([
                'dept_code'               => $request->dept_code,
                'dept_name'               => $request->dept_name,
                'remarks_dept'            => $request->remarks_dept,
            ]);
            DB::commit();
            return redirect('department')->with(['success' => 'Data Dept Code "' . $request->dept_name . '" berhasil di tambah !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function update(Request $request, $id)
    {
        // Update Data Department
        $dataDept = [
            'dept_code'               => $request->dept_code,
            'dept_name'               => $request->dept_name,
            'remarks_dept'            => $request->remarks_dept,
        ];
        Department::find($id)->update($dataDept);

        return redirect('department')->with(['success' => 'Data Dept Code "' . $request->dept_name . '" berhasil di Update !']);
    }
    public function delete($id)
    {
        $dept = Department::find($id);

        $del = $dept->delete();
        return response()->json([
            // "berhasil" => "Data Asset berhasil ditemukan",
        ]);
    }
}
