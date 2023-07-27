<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CrewController extends Controller
{
    //
    public function index()
    {
        $session_login = Auth::user()->username;
        $session_login_id = Auth::user()->personnel_number;

        // $asset = FixedAssets::where('vessel_id', '=', $session_login)->get();
        $asset =
            DB::table('fixed_assets')
            ->leftJoin('locations', 'fixed_assets.location_id', '=', 'locations.id')
            ->leftJoin('sites', 'locations.site_id', '=', 'sites.id')
            ->select('fixed_assets.*', 'locations.location_name', 'sites.site_code', 'sites.site_name')
            ->where('site_code', '=', $session_login_id)
            ->orderByDesc('fixed_assets.updated_at')
            ->get();

        // $user = User::where('username', '=', $session_login)->get();
        $user = User::orderBy('updated_at', 'desc')->get();

        // return view('crew.data_report_vessel', compact('asset', 'user'));
        return view('crew.data_report_vessel');
    }

    public function crew_report_json(Request $request)
    {

        //
        $on_tug = $request->on_tug;
        $asset = DB::table('fixed_assets')
            ->join('locations', 'fixed_assets.location_id', '=', 'locations.id')
            ->join('sites', 'locations.site_id', '=', 'sites.id')
            ->select('fixed_assets.*', 'locations.location_name', 'sites.site_code')
            ->where('site_code', $on_tug)
            // ->where('site_code', '=', '1903005')
            ->orderByDesc('fixed_assets.updated_at')
            ->get();
    }
}
