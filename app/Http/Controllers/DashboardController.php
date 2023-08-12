<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\Document;
use App\Models\Employee;
use App\Models\FixedAssets;
use App\Models\Location;
use App\Models\MappingAssetCategory;
use App\Models\PengajuanPinjaman;
use App\Models\Pengembalian;
use App\Models\Pinjaman;
use App\Models\Room;
use App\Models\Site;
use App\Models\StockTakeTransaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    // public function index()
    // {
    //     return view('dashboard.home_admin');
    // }

    public function home_admin()
    {
        $data["sumUser"] = User::count('id');
        $data["sumEmployee"] = Employee::count('id');
        // $data["sumCustomer"] = '';
        $data["sumVendor"] = Vendor::count('id');
        $data["sumVessel"] = Vessel::count('id');
        $data["sumSite"] = Site::count('id');
        $data["sumRoom"] = Room::count('id');
        $data["sumLocation"] = Location::count('id');
        $data["sumAsset"] = FixedAssets::count('id');
        $data["sumAssetCategory"] = AssetCategory::count('id');
        $data["sumMappingAssetCategory"] = MappingAssetCategory::count('id');
        $data["sumStockTake"] = StockTakeTransaction::count('id');
        $data["sumDocument"] = Document::count('id');
        $data["sumPengPinj"] = PengajuanPinjaman::count('id');
        $data["sumPinj"] = Pinjaman::count('id');
        $data["sumKembali"] = Pengembalian::count('id');
        return view('dashboard.home_admin', $data);
    }

    public function home_user()
    {
        return view('dashboard.home_user');
    }

    public function home_crew(Request $request)
    {
        if (Auth::user()->roles == 'admin') {
            $sites = Site::all();
            $site_code = $request->filter_sites;
        } elseif (Auth::user()->roles == 'vessel') {
            $sites = Site::where('site_code', Auth::user()->personnel_number)->get();
            $site_code = Auth::user()->personnel_number;
        }

        $location = DB::table('locations')
            ->join('rooms', 'locations.room_id', 'rooms.id')
            ->join('sites', 'locations.site_id', 'sites.id')
            ->where('site_code', $site_code)
            // ->where('site_id', '=', 'f745e990-9e2d-437f-a39e-65f6c1076864')
            ->get();
        // return $location->id;

        foreach ($location as $key => $value) {
            $parm_loc[] = $value->id;
            $parm_room[] = $value->room_id;
            $parm_site[] = $value->site_id;
        }
        // return $parm_loc;

        $mapping_asset = DB::table('mapping_asset_categories')
            ->join('asset_categories', 'mapping_asset_categories.asset_category_id', 'asset_categories.id')
            ->join('locations', 'mapping_asset_categories.location_id', 'locations.id')
            ->join('rooms', 'locations.room_id', 'rooms.id')
            ->join('sites', 'locations.site_id', 'sites.id')
            ->select('mapping_asset_categories.asset_category_id', 'mapping_asset_categories.location_id', 'locations.room_id', 'asset_categories.asset_category_name', 'sites.site_name', 'rooms.room_name')
            ->where('site_code', $site_code)
            ->get();
        // return $mapping_asset;

        $assets = DB::table('fixed_assets')->get();

        return view('dashboard.home_crew', compact('mapping_asset', 'location', 'assets', 'sites'));
    }

    // public function home_crew_backup()
    // {
    //     $session_login = Auth::user()->username;
    //     $session_login_id = Auth::user()->personnel_number;

    //     $asset =
    //         DB::table('fixed_assets')
    //         ->leftJoin('locations', 'fixed_assets.location_id', '=', 'locations.id')
    //         ->leftJoin('sites', 'locations.site_id', '=', 'sites.id')
    //         ->select('fixed_assets.*', 'locations.location_name', 'sites.site_code', 'sites.site_name')
    //         ->where('site_code', '=', $session_login_id)
    //         ->orderByDesc('fixed_assets.updated_at')
    //         ->get();

    //     // $user = User::where('username', '=', $session_login)->get();
    //     $user = User::orderBy('updated_at', 'desc')->get();

    //     $tugbarge = DB::connection('mysql-vms-prod')->table("settype_tugbarge")
    //         ->where('tug', $session_login_id)
    //         ->where('is_active', '=', 1)
    //         ->first();

    //     $data_tug = DB::table('sites')
    //         ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
    //         ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
    //         ->where('site_code', $session_login_id)->get();

    //     $data_barge = DB::table('sites')
    //         ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
    //         ->select('sites.*', 'vessels.vess_name', 'vessels.vess_type')
    //         ->where('site_code', $tugbarge->barge)->get();

    //     // return $data_barge;

    //     return view('dashboard.home_crew', compact('asset', 'user', 'data_tug', 'data_barge'));
    // }
}
