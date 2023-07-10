<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ScanVesselController extends Controller
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
        return view('scan_vessels.data', compact('data_tug'));
    }

    public function json()
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")->where('is_active', '=', 1)->get();
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
}
