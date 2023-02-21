<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    //

    public function index()
    {
        //
        return view('document.view');
    }

    public function json()
    {
        //
        $doc = Document::orderBy('updated_at', 'desc')->get();
        return DataTables::of($doc)
        // ->addColumn('tgl_posting', function($data){
        //     return $data->TransDate->format('d M Y H:i:s');
        // })
        ->make(true);
    }
}
