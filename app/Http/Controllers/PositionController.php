<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function index()
    {
        $dept = Department::all();

        return view('position.index', compact('dept'));
    }

    public function json()
    {
        $position = DB::table('positions')
            ->leftJoin('departments', 'positions.department_id', 'departments.id')
            ->select('positions.*', 'departments.dept_name')
            ->orderByDesc('positions.updated_at')
            ->get();

        return DataTables::of($position)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                    <a href="#" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset" data-toggle="modal" data-target="#edit_employee' . $data->id . '"><i class="fa fa-pencil"></i></a>
                    <button type="button" onclick="deleteData(`' . route('position.delete', $data->id) . '`)" class="btn btn-xs btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </div>
                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->addColumn('department_id', function ($data) {
                return $data->dept_name;
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
            Position::create([
                'position_code'               => $request->position_code,
                'position_name'               => $request->position_name,
                'remarks_position'            => $request->remarks_position,
                'department_id'               => $request->department_id,
            ]);
            DB::commit();
            return redirect('position')->with(['success' => 'Data Position "' . $request->position_name . '" berhasil di tambah !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        // Update Data Department
        $dataPosition = [
            'position_code'               => $request->position_code,
            'position_name'               => $request->position_name,
            'remarks_position'            => $request->remarks_position,
            'department_id '              => $request->department_id,
        ];
        Position::find($id)->update($dataPosition);

        return redirect('position')->with(['success' => 'Data Position "' . $request->position_name . '" berhasil di Update !']);
    }

    public function delete($id)
    {
        $position = Position::find($id);

        $del = $position->delete();
        return response()->json([
            // "berhasil" => "Data Asset berhasil ditemukan",
        ]);
    }
}
