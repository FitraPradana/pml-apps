<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FixedAssets;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class BarcodeController extends Controller
{
    //

    public function index()
    {
        // var_dump('test');
        return view('barcode.view', [
            'asset' => FixedAssets::all()
        ]);
    }

    public function scan()
    {
        return view('barcode.scan', [
            'asset' => FixedAssets::all()
        ]);
    }

    public function scanner($qrcodes)
    {
        $asset = FixedAssets::where('qr_code', '=', $qrcodes)->get();
        return response()->json($asset);
    }

    public function scanner_validasi(Request $request)
    {
        $fixed_assets = FixedAssets::where("qr_code", $request->qr_code)->first();

        if ($fixed_assets == null) {
            return response()->json([
                "status_error" => "Data Asset tidak ditemukan"
            ]);
        }

        return response()->json([
            "berhasil" => "Data Asset berhasil ditemukan",
            "number" => $fixed_assets->fixed_assets_number,
            "group" => $fixed_assets->fixed_assets_group,
            "name" => $fixed_assets->fixed_assets_name,
            "desc" => $fixed_assets->information3,
            "qr_code" => $fixed_assets->qr_code,
            "id" => $fixed_assets->id,
            "status" => $fixed_assets->status_asset,
            "remarks_fixed_assets" => $fixed_assets->remarks_fixed_assets,
        ]);

        // return response()->json(['result' => $fixed_assets]);
    }

    public function update(Request $request)
    {
        $dataFixedAsset = [
            'remarks_fixed_assets' => $request->remarks_fixed_assets,
            'status_asset' => $request->status_asset,
            'pic' => $request->pic
        ];
        FixedAssets::where('id', $request->id)->update($dataFixedAsset);

        // $dataTransaction = [
        //     'tgl_stock_take' => today(),
        //     'fixed_assets_number' => $request->remarks_fixed_assets,
        //     'remarks_fixed_assets' => $request->remarks_fixed_assets,
        //     'status_asset' => $request->status_asset,
        //     'pic' => $request->pic
        // ];

        return response()->json(['success' => "Berhasil melakukan update data"]);
        // return redirect('fixed_assets')->with('message', json_encode(['success'=>'sucessfull!']));
    }
}
