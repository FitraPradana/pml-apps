<?php

namespace App\Http\Controllers;

use App\Models\FixedAssets;
use App\Models\Location;
use App\Models\Site;
use App\Models\StockTakeTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Mail;

class ScanController extends Controller
{

    public function index()
    {
        return view('scan.scanner');
    }

    public function get_scan_qrcode(Request $request,)
    {
        $asset = FixedAssets::where("qr_code", $request->qr_code)->first();

        if ($asset == null) {
            return response()->json([
                "status_error" => "Data Asset tidak ditemukan"
            ]);
        }

        return response()->json([
            "berhasil" => "Data Asset berhasil ditemukan",
            "qr_code" => $asset->qr_code,
            "id" => $asset->id,
        ]);
    }

    public function show_edit($id)
    {
        $user = User::all();
        $site = Site::all();
        $location = Location::all();
        $asset = FixedAssets::where("id", $id)->first();
        $stock_take = StockTakeTransaction::all();
        return view('scan.update_scan_asset', compact('asset', 'user', 'site', 'stock_take', 'location'));
    }

    public function update_scan_asset(Request $request)
    {
        //validate form
        $this->validate(
            $request,
            [
                'status_asset'                  => 'required',
                'location_id'                   => 'required',
                'remarks_fixed_assets'          => 'required',
                'last_img_condition'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'last_img_condition.required'            => 'Wajib upload foto terbaru kondisi Asset saat ini !!'
            ]
        );

        // Img Condition Stock Take Transaction =============================
        // if($request->hasFile('last_img_condition')){
        //     $path = $request->file('last_img_condition')->store('stock_take_transaction');
        // }else{
        //     $path = '';
        // }
        // END Img Condition Stock Take Transaction =============================



        // $asset = FixedAssets::where("qr_code", $request->qr_code)->first();
        // $pathFoto = $asset->last_img_condition;

        // if($pathFoto != null || $pathFoto != ''){
        //     Storage::delete($pathFoto);
        // }

        // END Img Condition Stock Take Transaction =============================

        // Insert Stock Take Transaction
        $trans = StockTakeTransaction::create([
            'id'                            => $request->stock_take_transaction_id,
            'fixed_asset_id'                => $request->fixed_asset_id,
            'tgl_stock_take'                => today(),
            'status_asset'                  => $request->status_asset,
            'location_id'                       => $request->location_id,
            'remarks_stock_take'            => $request->remarks_fixed_assets,
            'last_update_name'              => Auth::user()->username,
            'last_img_condition_stock_take' => $request->file('last_img_condition')->store('stock_take_transaction'),
        ]);
        $LastInsertId_stock_take = $trans->id;

        // dd($LastInsertId_stock_take);

        // Update Data Fixed Assets
        $dataFixedAsset = [
            'remarks_fixed_assets'          => $request->remarks_fixed_assets,
            'status_asset'                  => $request->status_asset,
            'site_id'                       => $request->site_id,
            'last_update_stock_take_date'   => today(),
            'last_modified_name'            => Auth::user()->username,
            'last_img_condition_stock_take' => $request->file('last_img_condition')->store('stock_take_transaction'),
        ];
        FixedAssets::where('qr_code', $request->qr_code)->update($dataFixedAsset);

        if ($dataFixedAsset['status_asset'] == 'good') {
            // $result = (new SendMailController)->ba_status(['id' => $LastInsertId_stock_take]);

            $data["email"] = ["fitra.jaya@pml.co.id", "pradanafitrah45@gmail.com"];
            $data["title"] = "Admin Asset Management PML";
            $data["body"] = "Status Asset berhasil di Update";
            $data["today"] = today()->format('d-M-y');
            $data["stock_take"] = StockTakeTransaction::with('site')->where('id', $LastInsertId_stock_take)->first();

            $pdf = PDF::loadView('emails.ba_status.pdf', $data);

            Mail::send('emails.ba_status.body', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "BA Status Asset.pdf");
            });

            return redirect('fixed_assets')->with(['success' => 'Status Asset berhasil di Update !']);
        } else {

            $data["email"] = ["fitra.jaya@pml.co.id", "pradanafitrah45@gmail.com"];
            $data["title"] = "Admin Asset Management PML";
            $data["body"] = "Status Asset berhasil di Update";
            $data["today"] = today()->format('d-M-y');
            $data["stock_take"] = StockTakeTransaction::with('site')->where('id', $LastInsertId_stock_take)->first();

            $pdf = PDF::loadView('emails.ba_status.pdf', $data);

            Mail::send('emails.ba_status.body', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "BA Status Asset.pdf");
            });
            return redirect('fixed_assets')->with(['success' => 'Status Asset berhasil di Update !']);
        }

        // return redirect('fixed_assets')->with(['success' => 'Status Asset '. $request->fixed_assets_number .' Berhasil Di Update!']);
    }
}
