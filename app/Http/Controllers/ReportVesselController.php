<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportVesselController extends Controller
{
    //
    public function index()
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")->where('is_active', '=', 1)->get();
        foreach ($tugbarge as $key => $value) {
            $tugs[] = $value->tug;
        }
        $data_tug = DB::table('sites')
            ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
            ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
            ->whereIn('site_code', $tugs)->get();
        return view('report_vessels.data', compact('data_tug'));
    }

    public function get_asset_tug_json(Request $request)
    {

        $on_tug = $request->on_tug;
        $asset = DB::table('fixed_assets')
            ->join('locations', 'fixed_assets.location_id', '=', 'locations.id')
            ->join('sites', 'locations.site_id', '=', 'sites.id')
            ->select('fixed_assets.*', 'locations.location_name', 'sites.site_code')
            ->where('site_code', $on_tug)
            // ->where('site_code', '=', '1903005')
            ->orderByDesc('fixed_assets.updated_at')
            ->get();

        // return DataTables::of(FixedAssets::all())

        return DataTables::of($asset)
            ->editColumn('status_asset', function ($edit_status) {
                if ($edit_status->status_asset == 'GENERAL') {
                    return '<span class="badge bg-inverse-secondary"> GENERAL</span>';
                } elseif ($edit_status->status_asset == 'GOOD') {
                    return '<span class="badge bg-inverse-success">GOOD</span>';
                } elseif ($edit_status->status_asset == 'NEED_REPLACEMENT') {
                    return '<span class="badge bg-inverse-warning"> NEED REPLACEMENT</span>';
                } elseif ($edit_status->status_asset == 'NEED_REPAIR') {
                    return '<span class="badge bg-inverse-warning"> NEED REPAIR</span>';
                } elseif ($edit_status->status_asset == 'DONT_EXIST') {
                    return '<span class="badge bg-inverse-danger">  DONT EXIST</span>';
                }
            })
            ->editColumn('is_used', function ($edit_status) {
                if ($edit_status->is_used == 'GENERAL') {
                    return '<span class="badge bg-inverse-secondary">GENERAL</span>';
                } elseif ($edit_status->is_used == 'DIPAKAI') {
                    return '<span class="badge bg-inverse-success">DIPAKAI</span>';
                } elseif ($edit_status->is_used == 'TIDAK_DIPAKAI') {
                    return '<span class="badge bg-inverse-danger">TIDAK DIPAKAI</span>';
                }
            })
            ->addColumn('location_id', function ($data) {
                return $data->location_name;
            })
            ->addColumn('site_code', function ($data) {
                return $data->site_code;
            })
            ->rawColumns(['action', 'status_asset', 'is_used'])
            ->make(true);
    }

    public function get_asset_barge_json(Request $request)
    {
        $on_barge = $request->on_barge;
        $asset = DB::table('fixed_assets')
            ->join('locations', 'fixed_assets.location_id', '=', 'locations.id')
            ->join('sites', 'locations.site_id', '=', 'sites.id')
            ->select('fixed_assets.*', 'locations.location_name', 'sites.site_code')
            ->where('site_code', $on_barge)
            ->orderByDesc('fixed_assets.updated_at')
            ->get();

        // return DataTables::of(FixedAssets::all())

        return DataTables::of($asset)
            ->editColumn('status_asset', function ($edit_status) {
                if ($edit_status->status_asset == 'GENERAL') {
                    return '<span class="badge bg-inverse-secondary"> GENERAL</span>';
                } elseif ($edit_status->status_asset == 'GOOD') {
                    return '<span class="badge bg-inverse-success">GOOD</span>';
                } elseif ($edit_status->status_asset == 'NEED_REPLACEMENT') {
                    return '<span class="badge bg-inverse-warning"> NEED REPLACEMENT</span>';
                } elseif ($edit_status->status_asset == 'NEED_REPAIR') {
                    return '<span class="badge bg-inverse-warning"> NEED REPAIR</span>';
                } elseif ($edit_status->status_asset == 'DONT_EXIST') {
                    return '<span class="badge bg-inverse-danger">  DONT EXIST</span>';
                }
            })
            ->editColumn('is_used', function ($edit_status) {
                if ($edit_status->is_used == 'GENERAL') {
                    return '<span class="badge bg-inverse-secondary">GENERAL</span>';
                } elseif ($edit_status->is_used == 'DIPAKAI') {
                    return '<span class="badge bg-inverse-success">DIPAKAI</span>';
                } elseif ($edit_status->is_used == 'TIDAK_DIPAKAI') {
                    return '<span class="badge bg-inverse-danger">TIDAK DIPAKAI</span>';
                }
            })
            ->addColumn('location_id', function ($data) {
                return $data->location_name;
            })
            ->addColumn('site_code', function ($data) {
                return $data->site_code;
            })
            ->rawColumns(['action', 'status_asset', 'is_used'])
            ->make(true);
    }


    public function get_barge(Request $request)
    {
        //
        $on_tug = $request->on_tug;
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")
            ->where('tug', $on_tug)
            ->where('is_active', '=', 1)
            ->first();
        $site = DB::table("sites")
            ->where('site_code', $tugbarge->barge)
            ->first();

        return response()->json([
            "berhasil" => "Data Asset berhasil ditemukan",
            "id_tug" => $on_tug,
            "id_barge" => $tugbarge->barge,
            "nama_barge" => $site->site_name,
            // "id_barge" => $tugbarge->barge,
            // "vessel_name" => $tug->vess_name,
        ]);
    }










    public function json($tug_id)
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")
            ->where('is_active', '=', 1)
            // ->where('is_active', '=', 1)
            ->first();


        foreach ($tugbarge as $key => $value) {
            $tugs[] = $value->tug;
        }
        $tug = DB::table('sites')
            ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
            ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
            ->whereIn('site_code', $tugs)->get();


        return DataTables::of($tug)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function json_testing(Request $request)
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")
            ->where('is_active', '=', 1)
            ->where('tug', $request->id_tug)
            ->first();

        // return $tugbarge;

        // foreach ($tugbarge as $key => $value) {
        //     $tugs[] = $value->tug;
        // }

        // $filter = $tugbarge->tug;
        // $tug = DB::table('sites')
        //     // ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
        //     // ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
        //     ->whereIn('site_code', $filter)
        //     ->get();

        // dd($tugbarge->tug);


        return response()->json([
            "berhasil" => "Data Asset berhasil ditemukan",
            "id_tug" => $request->on_tug,
            // "id_barge" => $tugbarge->barge,
            // "vessel_name" => $tug->vess_name,
        ]);
    }
}
