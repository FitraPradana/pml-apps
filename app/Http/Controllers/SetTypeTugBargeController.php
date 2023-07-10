<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class SetTypeTugBargeController extends Controller
{
    //
    public function index()
    {
        return view('settype_tugbarge.view');
    }

    public function json()
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")->get();

        return DataTables::of($tugbarge)

            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function data_db()
    {
        // $stvessel  = SetTypeVessel::all();

        $site = DB::table('sites')->get();
        // $site_tug = $site['site_code']->first();

        foreach ($site as $key => $value) {
            # code...
            $site_codes[] = $value->site_code;
        }


        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")->where('is_active', '=', 1)->get();
        $collectdata = collect($tugbarge);
        // foreach ($tugbarge as $key => $value) {
        //     $tugs[] = $value->tug;
        //     $barges[] = $value->barge;
        // }
        // dd($barges);
        $filtered = $collectdata->whereIn('tug', $site_codes);
        return $filtered;
        // dd($tugbarge);
    }


    public function data_db2()
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")->where('is_active', '=', 1)->get();
        // $site = DB::table('sites')->get();
        // $collectdata = collect($site);
        return $tugbarge;
        foreach ($tugbarge as $key => $value) {
            $tugs[] = $value->tug;
            $barges[] = $value->barge;
        }

        // $filtered = $collectdata->where('site_code', $tugs);

        $site = DB::table('sites')
            ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
            ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
            ->whereIn('site_code', $tugs)->get();
        $barge = DB::table('sites')
            ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
            ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
            ->whereIn('site_code', $barges)->get();


        return $barge;
    }

    public function tbl_crew()
    {
        $tugbarge = DB::connection('mysql-vms-prod')->table("crew")->get();
    }
}
