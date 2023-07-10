<?php

namespace App\Http\Controllers;

use App\Imports\LocationImport;
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
        return view('location.view', compact(['room', 'site']));
    }

    public function json()
    {
        $loc = Location::with(['room', 'site'])->orderBy('updated_at', 'desc')->get();

        // $loc = DB::table('locations')
        //     ->leftJoin('rooms', 'rooms.id', '=', 'locations.room_id')
        //     ->leftJoin('sites', 'sites.id', '=', 'locations.site_id')
        //     ->select('locations.*', 'sites.site_name', 'rooms.room_name')
        //     ->orderByDesc('locations.updated_at')
        //     ->get();

        return DataTables::of($loc)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->addColumn('room_id', function ($data) {
                return $data->room->room_name;
            })
            ->addColumn('site_id', function ($data) {
                return $data->site->site_name;
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

        // Insert Site
        Location::create([
            'location_code'           => $request->location_code,
            'location_name'           => $request->location_name,
            'location_remarks'        => $request->location_remarks,
            'site_id'                 => $request->site_id,
            'room_id'                 => $request->room_id,
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
}
