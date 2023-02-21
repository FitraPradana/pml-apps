<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VesselController extends Controller
{
    //
    public function index()
    {
        return view('vessel.view');
    }

    public function json()
    {
        //
        $vessel = Vessel::orderBy('updated_at', 'desc')->get();

        return DataTables::of($vessel)
        ->addColumn('action', function($data){
            return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
