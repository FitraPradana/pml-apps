<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\FA_UpdateNetBookValueImport;
use App\Imports\FixedAssetsImport;
use App\Models\FixedAssets;
use App\Models\Site;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'asset' => FixedAssets::all()
        ]);
    }

    public function json()
    {
        // $asset = FixedAssets::leftJoin('users', 'fixed_assets.pic', '=', 'users.id')
        // ->get();
        $asset = FixedAssets::with('site')->orderBy('updated_at', 'desc')->get();

        // return DataTables::of(FixedAssets::all())
        return DataTables::of($asset)
            ->editColumn('status_asset', function ($edit_status) {
                if ($edit_status->status_asset == 'general') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-secondary"></i> General</a>';
                } elseif ($edit_status->status_asset == 'good') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> GOOD</a>';
                } elseif ($edit_status->status_asset == 'need') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Need Repair / Need Replacement</a>';
                } elseif ($edit_status->status_asset == 'dont_exist') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Dont Exist</a>';
                }
            })
            ->editColumn('last_img_condition_stock_take', function ($data) {
                if ($data->last_img_condition_stock_take) {
                    return '
                    <a href="' . asset('storage/' . $data->last_img_condition_stock_take) . '"> ' . asset('storage/' . $data->last_img_condition_stock_take) . ' </a>
                ';
                } else {
                    return '';
                }
            })
            ->addColumn('location_id', function ($data) {
                return $data->location->location_name;
            })
            ->addColumn('net_book_value', function ($data) {
                return rupiah($data->net_book_value);
            })
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->format('d M Y H:i:s');
            })
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                    <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
                    <a href="' . route('fixed_assets.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="fa fa-trash"></i></a>
                </div>
                ';
            })
            ->rawColumns(['action', 'status_asset', 'qr_code', 'last_img_condition_stock_take', 'net_book_value'])
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
        return view('fixed_assets.edit_form', compact('asset', 'user', 'site', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FixedAssets  $fixedAssets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FixedAssets $fixedAssets, $id)
    {
        //validate form
        $this->validate($request, [
            // 'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'fixed_assets_number'        => 'required',
            // 'fixed_assets_description'   => 'required',
            // 'acquisition_date'              => 'required',
            'net_book_value'                => 'required',
            'status_asset'                  => 'required',
            'site_id'                       => 'required',
            'remarks_fixed_assets'          => 'required',
        ]);

        $asset = FixedAssets::find($id);

        $asset->update([
            // 'acquisition_date'              => $request->acquisition_date,
            'net_book_value'                => $request->net_book_value,
            'status_asset'                  => $request->status_asset,
            'last_update_stock_take_date'   => Today(),
            'site_id'                       => $request->site_id,
            'remarks_fixed_assets'          => $request->remarks_fixed_assets,
            'last_modified_name'            => Auth::user()->username,
        ]);

        //redirect to index
        return redirect('fixed_assets')->with(['success' => 'Data Berhasil Diubah!']);
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
}
