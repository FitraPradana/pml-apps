<?php

namespace App\Http\Controllers;

use App\Imports\LocationImport;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Room;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    //

    public function index()
    {

        $room = Room::all();
        $site = Site::all();
        $employee = Employee::all();
        $location = Location::all();
        if (!$site->isEmpty() and !$room->isEmpty()) {
            if ($location->isEmpty()) {
                $this->import_location_auto();
            }
        }


        // $gnrl_loc = Location::where('location_code', '=', 'GNRL')->first();
        // if (!$site->isEmpty() and !$room->isEmpty()) {
        //     if (!$gnrl_loc) {
        //         $this->insert_general();
        //     }
        // }



        return view('location.view', compact(['room', 'site', 'employee']));
    }

    public function json()
    {
        // $loc = Location::with(['room', 'site'])->orderBy('updated_at', 'desc')->get();

        $loc = DB::table('locations')
            ->leftJoin('rooms', 'rooms.id', '=', 'locations.room_id')
            ->leftJoin('sites', 'sites.id', '=', 'locations.site_id')
            ->leftJoin('employees', 'employees.id', '=', 'locations.employee_id')
            ->select('locations.*', 'sites.site_name', 'rooms.room_name', 'employees.emp_name')
            ->orderByDesc('locations.updated_at')
            ->get();

        return DataTables::of($loc)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->addColumn('room_id', function ($data) {
                return $data->room_name;
            })
            ->addColumn('site_id', function ($data) {
                return $data->site_name;
            })
            ->addColumn('employee_id', function ($data) {
                return $data->emp_name;
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

        // Insert Location
        Location::create([
            'location_code'           => $request->location_code,
            'location_name'           => $request->location_name,
            'location_remarks'        => $request->location_remarks,
            'site_id'                 => $request->site_id,
            'room_id'                 => $request->room_id,
            'employee_id'             => $request->employee_id,
        ]);

        return redirect('locations')->with(['success' => 'Location Code ' . $request->location_code . ' Berhasil Di Tambahkan!']);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new LocationImport();
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/locations')->with('success', 'Data Location Berhasil di Import !!!');
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

    public function import_location_auto()
    {
        $path = public_path('document/Location Import.xlsx');

        $import = new LocationImport();
        $import->import($path);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/locations')->with('success', 'Data Location Berhasil di Import AUTOMATIC!!!');
    }
}
