<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Room;
use App\Models\Site;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    //

    public function index()
    {
        $room = Room::all();
        $site = Site::all();
        return view('location.view', compact(['room','site']));
    }

    public function json()
    {
        $loc = Location::orderBy('updated_at', 'desc')->get();

        return DataTables::of($loc)
        // ->addColumn('room_id', function($data){
        //     return $data->room->room_name;
        // })
        // ->addColumn('created_at', function($data){
        //     return $data->created_at->format('d M Y H:i:s');
        // })
        // ->addColumn('updated_at', function($data){
        //     return $data->updated_at->format('d M Y H:i:s');
        // })
        ->addColumn('action', function($data){
            return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
