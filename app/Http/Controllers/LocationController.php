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
        $employees = Employee::all();
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



        return view('location.view', compact(['room', 'site', 'employees']));
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
        $site = Site::where('id', $request->site_id)->first();
        $room = Room::where('id', $request->room_id)->first();
        $employee = Employee::where('id', $request->employee_id)->first();

        if ($room->room_code == 'GNRL') {
            if ($site->site_name == 'Banjarmasin' or $site->site_name == 'Jakarta') {
                $locCode = str_replace(' ', '_', strtoupper($site->site_code)) . '-' . str_replace(' ', '_', $employee->emp_name);
            } else {
                $locCode = str_replace(' ', '_', strtoupper($site->site_name)) . '-' . str_replace(' ', '_', $employee->emp_name);
            }
            $locName = strtoupper($site->site_name) . '-' . $employee->emp_name;
        } elseif ($employee->emp_accountnum == 'GNRL') {
            if ($site->site_name == 'Banjarmasin' or $site->site_name == 'Jakarta') {
                $locCode = str_replace(' ', '_', strtoupper($site->site_code)) . '-' . $room->room_code;
            } else {
                $locCode = str_replace(' ', '_', strtoupper($site->site_name)) . '-' . $room->room_code;
            }
            $locName = strtoupper($site->site_name) . '-' . $room->room_name;
        } else {
            if ($site->site_name == 'Banjarmasin' or $site->site_name == 'Jakarta') {
                $locCode = str_replace(' ', '_', strtoupper($site->site_code)) . '-' . $room->room_code . '-' . str_replace(' ', '_', $employee->emp_name);
            } else {
                $locCode = str_replace(' ', '_', strtoupper($site->site_name)) . '-' . $room->room_code . '-' . str_replace(' ', '_', $employee->emp_name);
            }
            $locName = strtoupper($site->site_name) . '-' . $room->room_name . '-' . $employee->emp_name;
        }

        // Insert Location
        $dataLocation = [
            'location_code'           => $locCode,
            'location_name'           => $locName,
            'location_remarks'        => $request->location_remarks,
            'site_id'                 => $request->site_id,
            'room_id'                 => $request->room_id,
            'employee_id'             => $request->employee_id,
        ];
        $checkLocCode = Location::where('location_code', $dataLocation['location_code'])->first();
        // return $dataLocation['location_code'];

        if ($checkLocCode) {
            return redirect('locations')->withErrors('Location Code "' . $locCode . '" has been already exists!');
        } else {
            Location::create($dataLocation);
            return redirect('locations')->with('success', 'Location Code "' . $locCode . '" has been successfully added to the website!');
        }
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
