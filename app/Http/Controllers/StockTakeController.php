<?php

namespace App\Http\Controllers;

use App\Models\StockTakeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class StockTakeController extends Controller
{
    //

    public function index()
    {
        //
        return view('stock_take.view');
    }

    public function json()
    {
        //
        if (Auth::user()->roles == 'admin') {
            $stock_take = DB::table('stock_take_transactions')
                ->leftJoin('fixed_assets', 'stock_take_transactions.fixed_asset_id', 'fixed_assets.id')
                ->leftJoin('locations', 'stock_take_transactions.location_id', 'locations.id')
                ->select('stock_take_transactions.*', 'fixed_assets.fixed_assets_number', 'fixed_assets.information3', 'locations.location_name')
                ->orderByDesc('stock_take_transactions.updated_at')
                ->get();
        } elseif (Auth::user()->roles == 'user') {
            $stock_take = DB::table('stock_take_transactions')
                ->leftJoin('fixed_assets', 'stock_take_transactions.fixed_asset_id', 'fixed_assets.id')
                ->leftJoin('locations', 'stock_take_transactions.location_id', 'locations.id')
                ->leftJoin('employees', 'locations.employee_id', '=', 'employees.id')
                ->select('stock_take_transactions.*', 'fixed_assets.fixed_assets_number', 'fixed_assets.information3', 'locations.location_name')
                ->where('emp_accountnum', Auth::user()->personnel_number)
                ->orderByDesc('stock_take_transactions.updated_at')
                ->get();
        } elseif (Auth::user()->roles == 'vessel') {
            $stock_take = DB::table('stock_take_transactions')
                ->leftJoin('fixed_assets', 'stock_take_transactions.fixed_asset_id', 'fixed_assets.id')
                ->leftJoin('locations', 'stock_take_transactions.location_id', 'locations.id')
                ->leftJoin('sites', 'locations.site_id', '=', 'sites.id')
                ->select('stock_take_transactions.*', 'fixed_assets.fixed_assets_number', 'fixed_assets.information3', 'locations.location_name')
                ->where('site_code', Auth::user()->personnel_number)
                ->orderByDesc('stock_take_transactions.updated_at')
                ->get();
        }



        // if (Auth::user()->roles == 'admin') {
        //     $stock_take = StockTakeTransaction::with(['location', 'fixed_asset'])->orderBy('stock_take_transactions.updated_at', 'desc')->get();
        // } else {
        //     $stock_take = StockTakeTransaction::with(['location', 'fixed_asset'])->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        // }

        return DataTables::of($stock_take)
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    return '
                <div class="form group" align="center">
                <a href="' . route('print.stock_take', $data->id) . '" target="_blank" class="edit btn btn-xs btn-dark btn-flat btn-sm editAsset"><i class="fa fa-print"></i></a>
                </div>
                ';
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
            ->addColumn('tgl_stock_take', function ($data) {
                return Carbon::parse($data->tgl_stock_take)->format('d M Y');
            })
            ->rawColumns(['action', 'status_asset', 'is_used', 'last_img_condition_stock_take'])
            ->make(true);
    }

    public function print_stock_take($id)
    {
        $data["today"] = today()->format('d-M-y');
        $data["stock_take"] =
            DB::table('stock_take_transactions')
            ->leftJoin('fixed_assets', 'stock_take_transactions.fixed_asset_id', '=', 'fixed_assets.id')
            ->leftJoin('locations', 'stock_take_transactions.location_id', '=', 'locations.id')
            ->select('stock_take_transactions.*', 'fixed_assets.fixed_assets_number', 'fixed_assets.fixed_assets_name', 'fixed_assets.acquisition_date', 'locations.location_name')
            ->where('stock_take_transactions.id', $id)
            ->first();

        $pdf = PDF::loadView('emails.ba_status.pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
