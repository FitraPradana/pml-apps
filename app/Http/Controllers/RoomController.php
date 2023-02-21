<?php

namespace App\Http\Controllers;

use App\Imports\RoomImport;
use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    //
    public function index()
    {
        $room = Room::all();
        if($room->isEmpty())
        {
            $this->import_room_auto();
        }


        return view('room.view');
    }

    public function json()
    {
        $room = Room::orderBy('updated_at', 'desc')->get();

        return DataTables::of($room)
        ->addColumn('created_at', function($data){
            return $data->created_at->format('d M Y H:i:s');
        })
        ->addColumn('updated_at', function($data){
            return $data->updated_at->format('d M Y H:i:s');
        })
        ->addColumn('action', function($data){
            return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        })
        ->rawColumns(['action','name'])
        ->make(true);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new RoomImport();
        $import->import($file);

        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/rooms')->with('success', 'Data Room Berhasil di Import !!!');
    }

    public function import_room_auto()
    {
        $path = public_path('document/Room Import.xlsx');

        $import = new RoomImport();
        $import->import($path);

        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/rooms')->with('success', 'Data Room Berhasil di Import AUTOMATIC!!!');
    }
}
