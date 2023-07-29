<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\FixedAssets;
use App\Models\Location;
use App\Models\Room;
use App\Models\Site;
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
        $sumAsset = FixedAssets::count('id');
        $sumDocument = Document::count('id');
        $sumUser = User::count('id');
        $sumEmployee = Employee::count('id');
        $sumVessel = Vessel::count('id');
        $sumSite = Site::count('id');
        $sumRoom = Room::count('id');
        $sumLocation = Location::count('id');
        $sumVendor = Vendor::count('id');
        return view(
            'dashboard.home_admin',
            compact('sumAsset', 'sumDocument', 'sumUser', 'sumEmployee', 'sumVendor', 'sumVessel', 'sumSite', 'sumRoom', 'sumLocation')
        );
    }

    public function home_staff()
    {
        return view('dashboard.home_staff');
    }

    public function home_crew()
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

        return view('dashboard.home_crew', compact('asset', 'user'));
        // return view('dashboard.home_crew');
    }
}
