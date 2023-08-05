<?php

namespace App\Http\Controllers;

use App\Imports\AssetCategoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AssetCategory;
use App\Models\Location;
use App\Models\MappingAssetCategory;
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
        $asset_category = DB::table('asset_categories')
            ->orderByDesc('asset_categories.updated_at')
            ->get();
        return DataTables::of($asset_category)
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    return '
                    <div class="form group" align="center">
                    <a data-toggle="modal" id="smallButton"  href="' . route('document.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                    </div>
                    ';
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

        return redirect('/asset_category')->with('success', 'Data Mapping Asset Category Berhasil di Import AUTOMATIC!!!');
    }



    public function map_ast_cat_view()
    {
        $asset_category = AssetCategory::all();
        $location = Location::all();
        return view('asset_category.mapping_asset_category.view', compact('location', 'asset_category'));
    }

    public function map_ast_cat_view_json()
    {
        $mapping_asset_categories = DB::table('mapping_asset_categories')
            ->leftJoin('asset_categories', 'asset_categories.id', '=', 'mapping_asset_categories.asset_category_id')
            ->leftJoin('locations', 'locations.id', '=', 'mapping_asset_categories.location_id')
            ->select('mapping_asset_categories.*', 'asset_categories.asset_category_name', 'locations.location_name')
            ->orderByDesc('mapping_asset_categories.updated_at')
            ->get();
        return DataTables::of($mapping_asset_categories)
            ->addColumn('location_id', function ($data) {
                return $data->location_name;
            })
            ->addColumn('asset_category_id', function ($data) {
                return $data->asset_category_name;
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    return '
                    ';
                    // <div class="form group" align="center">
                    //     <a href="' . route('map_ast_cat_delete', $data->id) . '" class="btn btn-xs btn-danger btn-flat btn-sm deleteAssetCategory"><i class="fa fa-trash"></i></a>
                    // </div>
                }
                // <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteAssetCategory"><i class="fa fa-trash"></i></a>
                // <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDoc"><i class="fa fa-trash"></i></a>
                // <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function map_ast_cat_save(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->asset_category_id as $key => $asset_category_ids) {
                MappingAssetCategory::create([
                    'location_id'                           => $request->location_id,
                    'asset_category_id'                     => $asset_category_ids,
                    'remarks_mapping_asset_category'        => $request->remarks_mapping_asset_category,
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect('map_ast_cat_view')->with(['success' => 'Data Mapping Asset Category Berhasil Di Simpan !']);
    }

    public function map_ast_cat_delete($id)
    {
        $map_ast_cat = MappingAssetCategory::find($id)->delete();
        return redirect('/form_asset_view')->with('success', 'Data Mapping Asset Category ' . $map_ast_cat->id . ' Berhasil di Hapus !!!');
    }
}
