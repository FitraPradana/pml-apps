<?php

namespace App\Http\Controllers;

use App\Imports\AssetCategoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AssetCategory;
use Illuminate\Support\Facades\Auth;

class AssetCategoryController extends Controller
{
    //

    public function index()
    {
        //
        $asset_category = AssetCategory::all();
        if ($asset_category->isEmpty()) {
            $this->auto_import_asset_category();
        }
        return view('asset_category.data');
    }

    public function json()
    {
        //
        $doc = DB::table('asset_categories')
            ->orderByDesc('asset_categories.updated_at')
            ->get();
        return DataTables::of($doc)
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    return '
                    ';
                    // <div class="form group" align="center">
                    // <a href="' . route('document.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                    // </div>
                }
                // <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDoc"><i class="fa fa-trash"></i></a>
                // <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function auto_import_asset_category()
    {
        $path = public_path('document/Asset Category.xlsx');

        $import = new AssetCategoryImport();
        $import->import($path);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/asset_category')->with('success', 'Data Location Berhasil di Import AUTOMATIC!!!');
    }
}
