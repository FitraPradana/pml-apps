<?php

namespace App\Http\Controllers;

use App\Imports\DocumentImport;
use App\Imports\UpdateStatusDocumentImport;
use App\Models\Document;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    //

    public function index()
    {
        //
        // Validasi Table VEndor Kosong
        // $vendor_kosong = Vendor::isEmpty();

        return view('document.view');
    }

    public function json()
    {
        //
        $doc = DB::table('documents')
            ->join('vendors', 'documents.vendor_id', '=', 'vendors.id')
            ->select('documents.*', 'vendors.vend_name')
            ->orderByDesc('documents.tgl_posting')
            ->get();
        return DataTables::of($doc)
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">
                <a href="' . route('document.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDoc"><i class="fa fa-trash"></i></a>
                </div>
                ';
                // <a href="' . route('generate.qr_code', $data->id) . '" class="btn btn-success btn-sm">Barcode</a>
            })
            ->editColumn('status_doc', function ($edit_status) {
                if ($edit_status->status_doc == 'GENERAL') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-secondary"></i> General</a>';
                } elseif ($edit_status->status_doc == 'TERSEDIA') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> TERSEDIA</a>';
                } elseif ($edit_status->status_doc == 'BELUM_TERSEDIA') {
                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Belum Tersedia</a>';
                }
            })
            ->addColumn('vendor_id', function ($data) {
                return $data->vend_name;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('tgl_posting', function ($data) {
                return Carbon::parse($data->tgl_posting)->format('d M Y');
            })
            ->addColumn('last_settle_date', function ($data) {
                return Carbon::parse($data->last_settle_date)->format('d M Y');
            })
            ->addColumn('nominal', function ($data) {
                return rupiah($data->nominal);
            })
            ->addColumn('tgl_terima_doc', function ($data) {
                if ($data->tgl_terima_doc == null) {
                    return Carbon::parse('01 Jan 1900')->format('d M Y');
                } else {
                    return Carbon::parse($data->tgl_terima_doc)->format('d M Y');
                }
            })
            ->rawColumns(['action', 'status_doc'])
            ->make(true);
    }

    public function edit($id)
    {
        $doc = Document::find($id);
        // $user = User::all();
        // $site = Site::all();
        // $location = Location::all();
        return view('document.edit_form', compact('doc'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            // 'image'               => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pic'                    => 'required',
            'tgl_terima_doc'         => 'required',
        ]);

        $doc = Document::find($id);
        $doc->update([
            'pic'                           => $request->pic,
            'status_doc'                    => $request->status_doc,
            'tgl_terima_doc'                => $request->tgl_terima_doc,
            'lemari'                        => $request->lemari,
            'lorong'                        => $request->lorong,
            'baris'                         => $request->baris,
            'no_folder'                     => $request->no_folder,
            'ket_doc'                       => $request->ket_doc,
        ]);

        //redirect to index
        return redirect('documents')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        //
        // $doc = Document::find($id);
        // $pathFoto = $asset->last_img_condition;

        // if ($pathFoto != null || $pathFoto != '') {
        //     Storage::delete($pathFoto);
        // }

        $doc = Document::find($id)->delete();

        return response()->json(['success' => 'Document deleted successfully.']);
    }


    public function import(Request $request)
    {
        // Validasi Table VEndor Kosong
        // $vendor_valid = Vendor::all();
        // if ($vendor_valid->isEmpty()) {
        //     return redirect('documents')->with(['error_vendor_kosong' => 'Data Vendor masih KOSONG, Harap isi pada Form ROOM !']);
        // }


        $file = $request->file('file')->store('public/import');

        $import_doc = new DocumentImport;
        $import_doc->import($file);

        if ($import_doc->failures()->isNotEmpty()) {
            return back()->withFailures($import_doc->failures());
        }

        return redirect('/documents')->with('success', 'Data Document berhasil di Tambahkan !!!');
    }

    public function update_doc_status(Request $request)
    {
        $file = $request->file('file')->store('public/update_document_status');

        $update_doc_status = new UpdateStatusDocumentImport;
        $update_doc_status->import($file);

        return redirect('/documents')->with('success', 'Document berhasil di Compare !!!');
    }
}
