<?php

namespace App\Http\Controllers;

use App\Exports\SiteExport;
use App\Imports\SiteImport;
use App\Models\Room;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class SiteController extends Controller
{
    //

    public function index()
    {
        $room = Room::all();
        $site = Site::all();
        // if($site->isEmpty())
        // {
        //     $this->import_site_auto();
        // }

        return view('site.view', compact('room'));
    }

    public function json()
    {
        // $site = Site::with('vessel')->orderBy('updated_at', 'desc')->get();
        $site = DB::table('sites')
            ->leftJoin('vessels', 'sites.vessel_id', '=', 'vessels.id')
            ->select('sites.*', 'vessels.vess_name')
            ->get();

        return DataTables::of($site)
            ->addColumn('vessel_id', function ($data) {
                return $data->vess_name;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('action', function ($data) {
                return '
                <div class="form group" align="center">

                ';
                // <button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
            })
            ->rawColumns(['action', 'name', 'room_id'])
            ->make(true);
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            // 'site_code'              => 'required',
            'site_name'              => 'required',
            // 'room_id'                => 'required',
        ]);

        // Insert Site
        Site::create([
            'site_code'               => $request->site_code,
            'site_name'               => $request->site_name,
            'remarks_site'            => $request->remarks_site,
            'room_id'                 => $request->room_id,
        ]);

        return redirect('sites')->with(['success' => 'Site Code ' . $request->site_code . ' Berhasil Di Tambah!']);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new SiteImport();
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/sites')->with('success', 'Data Site Berhasil di Import !!!');
    }

    public function import_site_auto()
    {
        $path = public_path('document/Site Import.xlsx');

        $import = new SiteImport();
        $import->import($path);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect('/sites')->with('success', 'Data Site Berhasil di Import AUTOMATIC!!!');
    }

    public function export()
    {
        return Excel::download(new SiteExport, 'sites.xlsx');
    }
}
