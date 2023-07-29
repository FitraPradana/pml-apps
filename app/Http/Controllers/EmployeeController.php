<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $Employee = Employee::orderBy('updated_at', 'desc')->get();

        return DataTables::of($Employee)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

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
