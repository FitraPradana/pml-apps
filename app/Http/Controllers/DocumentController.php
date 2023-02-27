<?php

namespace App\Http\Controllers;

use App\Imports\DocumentImport;
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


    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import_doc = new DocumentImport;
        $import_doc->import($file);

        if ($import_doc->failures()->isNotEmpty()) {
            return back()->withFailures($import_doc->failures());
        }

        return redirect('/documents')->with('success', 'Data Document berhasil di Update !!!');
    }
}
