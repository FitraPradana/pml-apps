<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\FA_UpdateNetBookValueImport;
use App\Imports\FixedAssetsImport;
use App\Models\AssetCategory;
use App\Models\FixedAssets;
use App\Models\Site;
use App\Models\User;
use App\Models\Location;
use App\Models\LogTransFixedAssets;
use App\Models\MappingAssetCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class FixedAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fixed_assets.view', [
            'asset' => FixedAssets::all(),
            'asset_category' => AssetCategory::all()
        ]);
    }

    public function json()
    {
        // $asset = FixedAssets::with('site')->orderBy('updated_at', 'desc')->get();
        // return Auth::user()->roles;
        if (Auth::user()->roles == 'admin') {
            $asset = DB::table('fixed_assets')
                ->leftJoin('locations', 'fixed_assets.location_id', '=', 'locations.id')
                ->leftJoin('asset_categories', 'fixed_assets.asset_category_id', '=', 'asset_categories.id')
                ->select('fixed_assets.*', 'locations.location_name', 'asset_categories.asset_category_name')
                ->orderByDesc('fixed_assets.updated_at')
                ->get();
        } elseif (Auth::user()->roles == 'user') {
            $asset = DB::table('fixed_assets')
                ->leftJoin('locations', 'fixed_assets.location_id', '=', 'locations.id')
                ->leftJoin('employees', 'locations.employee_id', '=', 'employees.id')
                ->leftJoin('asset_categories', 'fixed_assets.asset_category_id', '=', 'asset_categories.id')
                ->select('fixed_assets.*', 'locations.location_name', 'asset_categories.asset_category_name')
                ->where('emp_accountnum', Auth::user()->personnel_number)
                ->orderByDesc('fixed_assets.updated_at')
                ->get();
        } elseif (Auth::user()->roles == 'vessel') {
            $asset = DB::table('fixed_assets')
                ->leftJoin('locations', 'fixed_assets.location_id', '=', 'locations.id')
                ->leftJoin('sites', 'locations.site_id', '=', 'sites.id')
                ->leftJoin('asset_categories', 'fixed_assets.asset_category_id', '=', 'asset_categories.id')
                ->select('fixed_assets.*', 'locations.location_name', 'asset_categories.asset_category_name')
                ->where('site_code', Auth::user()->personnel_number)
                ->orderByDesc('fixed_assets.updated_at')
                ->get();
        }


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
            ->editColumn('img_asset', function ($data) {
                if ($data->img_asset) {
                    return '
                    <a href="' . asset('storage/' . $data->img_asset) . '"><button type="button" class="btn btn-info btn-sm">Preview Img</button></a>
                    ';
                    // <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"> ' . asset('storage/' . $data->last_img_condition_stock_take) . ' </a>
                } else {
                    return '';
                }
            })
            ->editColumn('last_img_condition_stock_take', function ($data) {
                if ($data->last_img_condition_stock_take) {
                    return '
                    <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"><button type="button" class="btn btn-info btn-sm">Preview Img</button></a>
                    ';
                    // <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"> ' . asset('storage/' . $data->last_img_condition_stock_take) . ' </a>
                } else {
                    return '';
                }
            })
            ->addColumn('location_id', function ($data) {
                return $data->location_name;
            })
            ->addColumn('asset_category_id', function ($data) {
                return $data->asset_category_name;
            })
            ->addColumn('net_book_value', function ($data) {
                return rupiah($data->net_book_value);
            })
            ->addColumn('acquisition_date', function ($data) {
                return Carbon::parse($data->acquisition_date)->format('d M Y');
            })
            ->addColumn('last_update_stock_take_date', function ($data) {
                return Carbon::parse($data->last_update_stock_take_date)->format('d M Y');
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                    <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
                    <a href="' . route('fixed_assets.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                    </div>
                    ';
                // <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="fa fa-trash"></i></a>
            })
            ->rawColumns(['action', 'status_asset', 'is_used', 'qr_code', 'last_img_condition_stock_take', 'net_book_value'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedAssets  $fixedAssets
     * @return \Illuminate\Http\Response
     */
    public function show(FixedAssets $fixedAssets, $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedAssets  $fixedAssets
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedAssets $fixedAssets, $id)
    {
        $user = User::all();
        $asset = FixedAssets::find($id);
        $site = Site::all();
        $location = Location::all();
        $asset_category = AssetCategory::all();
        return view('fixed_assets.edit_form', compact('asset', 'user', 'site', 'location', 'asset_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FixedAssets  $fixedAssets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $ip_saya = request()->ip();
            //validate form
            // $this->validate($request, [
            //     // 'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //     // 'fixed_assets_number'        => 'required',
            //     // 'fixed_assets_description'   => 'required',
            //     // 'acquisition_date'              => 'required',
            //     // 'net_book_value'                => 'required',
            //     'status_asset'                  => 'required',
            //     'location_id'                   => 'required',
            //     'remarks_fixed_assets'          => 'required',
            // ]);

            // IMG CONDITION
            if ($request->last_img_condition == '') {
                $update_img = $request->last_img_condition_stock_take;
            } else {
                $update_img = $request->file('last_img_condition')->store('stock_take_transaction');
            }
            // END IMG CONDITION

            $assets = FixedAssets::find($id);
            $assets->update([
                // 'acquisition_date'              => $request->acquisition_date,
                // 'net_book_value'                => $request->net_book_value,
                'status_asset'                  => $request->status_asset,
                'is_used'                       => $request->is_used,
                'last_update_stock_take_date'   => Today(),
                'location_id'                   => $request->location_id,
                'asset_category_id'             => $request->asset_category_id,
                'remarks_fixed_assets'          => $request->remarks_fixed_assets,
                'last_modified_name'            => Auth::user()->username,
                'last_img_condition_stock_take' => $update_img,
            ]);

            //Save Tbl Log Trans Fixed Assets
            $LogTransFixedAssets = LogTransFixedAssets::create([
                'log_transdate'                     => Carbon::now(),
                'remarks_log'                       => $request->remarks_fixed_assets,
                'last_img_condition_stock_take'     => $update_img,
                'last_update_name'                  => Auth::user()->username,
                'ip_user_update'                    => $ip_saya,
                'type_update'                       => 'FORM EDIT FIXED ASSETS',
                'status_asset'                      => $request->status_asset,
                'is_used'                           => $request->is_used,
                'fixed_asset_id'                    => $id,
                'location_id'                       => $request->location_id,
                'user_id'                           => Auth::user()->id,
            ]);



            DB::commit();
            //redirect to index
            return redirect('fixed_assets')->with(['success' => 'Data Assets ' . $request->fixed_assets_number . ' Berhasil Diubah!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedAssets  $fixedAssets
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedAssets $fixedAssets, $id)
    {
        //
        $asset = FixedAssets::find($id);
        $pathFoto = $asset->last_img_condition;

        if ($pathFoto != null || $pathFoto != '') {
            Storage::delete($pathFoto);
        }

        $asset = FixedAssets::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.', $asset]);
    }

    public function import_nbv(Request $request)
    {
        $file = $request->file('file')->store('public/update_nbv');

        $import_nbv = new FA_UpdateNetBookValueImport;
        $import_nbv->import($file);

        return redirect('/fixed_assets')->with('success', 'NBV berhasil di Update !!!');
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new FixedAssetsImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/fixed_assets')->with('success', 'Data Fixed Asset Berhasil di Import !!!');
    }

    // public function export()
    // {
    //     return Excel::download(new UserExport, 'users.xlsx');
    // }

    public function generate($id)
    {
        $data = FixedAssets::findOrFail($id);
        $code = $data->qr_code;
        $qrcode = QrCode::size(400)->generate($data->qr_code);
        return view('barcode.generate', compact('qrcode', 'code', 'data'));
    }





    public function form_asset_view(Request $request)
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

        return view('fixed_assets.form_asset_pml.view', compact('mapping_asset', 'location', 'assets', 'sites'));
    }

    public function log_trans_asset_view()
    {
        return view('fixed_assets.log_trans_asset.view');
    }

    public function log_trans_asset_json()
    {
        $log_trans_asset = DB::table('log_trans_fixed_assets')
            ->leftJoin('fixed_assets', 'log_trans_fixed_assets.fixed_asset_id', 'fixed_assets.id')
            ->leftJoin('locations', 'log_trans_fixed_assets.location_id', 'locations.id')
            ->select('log_trans_fixed_assets.*', 'fixed_assets.fixed_assets_number', 'fixed_assets.information3', 'locations.location_name')
            ->get();

        // return $log_trans_asset;

        return DataTables::of($log_trans_asset)
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    return '
                    ';
                    // <div class="form group" align="center">
                    // <a href="' . route('print.stock_take', $data->id) . '" target="_blank" class="edit btn btn-xs btn-dark btn-flat btn-sm editAsset"><i class="fa fa-print"></i></a>
                    // </div>
                }
                // <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDoc"><i class="fa fa-trash"></i></a>
                // <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
            })
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
            ->editColumn('last_img_condition_stock_take', function ($data) {
                if ($data->last_img_condition_stock_take) {
                    return '
                    <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"><button type="button" class="btn btn-info btn-sm">Preview Img</button></a>

                    ';
                    // <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"> ' . asset('storage/' . $data->last_img_condition_stock_take) . ' </a>
                } else {
                    return '';
                }
            })
            ->addColumn('fixed_asset_id', function ($data) {
                return $data->fixed_assets_number;
            })
            ->addColumn('fixed_asset_name', function ($data) {
                return $data->information3;
            })
            ->addColumn('location_id', function ($data) {
                return $data->location_name;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('log_transdate', function ($data) {
                return Carbon::parse($data->log_transdate)->format('d M Y');
            })
            ->rawColumns(['action', 'status_asset', 'is_used', 'last_img_condition_stock_take'])
            ->make(true);
    }
}
