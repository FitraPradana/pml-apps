<?php

namespace App\Http\Controllers;

use App\Imports\RoomImport;
use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoomExport;

class RoomController extends Controller
{
    //
    public function index()
    {
        $room = Room::all();
        if ($room->isEmpty()) {
            $this->import_room_auto();
        }


        return view('room.view');
    }

    public function json()
    {
        $room = Room::orderBy('updated_at', 'desc')->get();

        return DataTables::of($room)
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->format('d M Y H:i:s');
            })
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->rawColumns(['action', 'name'])
            ->make(true);
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            // 'site_code'              => 'required',
            'room_name'              => 'required',
            // 'room_id'                => 'required',
        ]);

        // Insert Site
        Room::create([
            'room_code'               => $request->room_code,
            'room_name'               => $request->room_name,
            'remarks_room'            => $request->remarks_room,
        ]);

        return redirect('rooms')->with('success', 'room code "' . $request->room_code . '" has been successfully added to the website!');
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new RoomImport();
        $ret = $import->import($file);
        // dd($import);

        if ($import->failures()->isNotEmpty()) {
            $error = $import->failures();
        }

        return redirect('/rooms')->with('success', 'Data Room has been successfully imported to the website !!!')->withFailures($error);
    }

    public function import_room_auto()
    {
        $path = public_path('document/Room Import.xlsx');

        $import = new RoomImport();
        $import->import($path);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/rooms')->with('success', 'Data Room Berhasil di Import AUTOMATIC!!!');
    }

    public function room_import_template()
    {
        return Excel::download(new RoomExport, 'Room import template.xlsx');
    }

    public function export()
    {
        return Excel::download(new RoomExport, 'rooms.xlsx');
    }
}
