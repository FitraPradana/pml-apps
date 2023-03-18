<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanPinjaman;
use App\Models\DetailPinjaman;
use App\Models\Document;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PengajuanPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = DB::table('documents')
            ->join('vendors', 'documents.vendor_id', '=', 'vendors.id')
            ->select('documents.*', 'vendors.vend_name')
            ->get();

        return view('pengajuan_pinjaman.view', compact('document'));
    }

    public function json()
    {
        $id_user = Auth::user()->id;
        //
        if (Auth::user()->roles == 'admin') {
            $query = DB::table('pengajuan_pinjaman')
                ->join('users', 'pengajuan_pinjaman.user_id', '=', 'users.id')
                ->select('pengajuan_pinjaman.*', 'users.username')
                ->where('approval_status', '!=', 'approved')
                ->orderByDesc('pengajuan_pinjaman.updated_at')
                ->get();
        } elseif (Auth::user()->roles == 'staff') {
            $query = DB::table('pengajuan_pinjaman')
                ->join('users', 'pengajuan_pinjaman.user_id', '=', 'users.id')
                ->select('pengajuan_pinjaman.*', 'users.username')
                ->where('approval_status', '!=', 'approved')
                ->where('user_id', $id_user)
                ->orderByDesc('pengajuan_pinjaman.updated_at')
                ->get();
        }
        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                if (Auth::user()->roles == 'admin') {
                    if ($data->approval_status == 'open') {
                        return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('pengajuan_pinjaman.approve', $data->id) . '" style="color: blue;">APPROVE</a>
                                <a class="dropdown-item" href="' . route('pengajuan_pinjaman.reject', $data->id) . '" style="color: red;">REJECT</a>
                            </div>
                    </div>

                    ';
                    }
                }
            })
            ->editColumn('approval_status', function ($edit_status) {
                if ($edit_status->approval_status == 'open') {
                    return '<span class="badge bg-inverse-warning">OPEN</span>';
                } elseif ($edit_status->approval_status == 'approved') {
                    return '<span class="badge bg-inverse-success">APPROVED</span>';
                } elseif ($edit_status->approval_status == 'rejected') {
                    return '<span class="badge bg-inverse-danger">REJECTED</span>';
                }
            })
            ->addColumn('user_id', function ($data) {
                return $data->username;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('tgl_pengajuan_pinjaman', function ($data) {
                return Carbon::parse($data->tgl_pengajuan_pinjaman)->format('d M Y');
            })
            ->addColumn('detail', function ($data) {
                $detail = collect(DetailPengajuanPinjaman::where('pengajuan_pinjaman_id', $data->id)->get());
                return '
                <a href="' . route('detail_pengajuan_pinjaman', $data->id) . '" class="btn btn-sm btn-primary">' . $detail->count() . ' Documents</a>
                ';
            })
            ->rawColumns(['action', 'approval_status', 'detail'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        //Save Tbl Pengajuan Pinjaman
        $PengPinjSave = PengajuanPinjaman::create([
            'tgl_pengajuan_pinjaman'    => Carbon::now(),
            'ket_pengajuan_pinjaman'    => $request->ket_pengajuan_pinjaman,
            // 'approval_status'           => 'open',
            'user_id'                   => Auth::user()->id,
        ]);
        $lastInsertid_PengPinj = PengajuanPinjaman::where('kode_pengajuan_pinjaman', $PengPinjSave->kode_pengajuan_pinjaman)->first();

        //Save Tbl Detail Pengajuan Pinjaman
        foreach ($request->document_id as $key => $document_ids) {
            # code...
            $DetPengPinjSave = DetailPengajuanPinjaman::create([
                'pengajuan_pinjaman_id' => $lastInsertid_PengPinj->id,
                'document_id' => $document_ids,
            ]);
        }

        DB::commit();

        return redirect('pengajuan_pinjamans')->with(['success' => 'Pengajuan Pinjaman Document berhasil di Tambahkan !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengajuanPinjaman  $pengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(PengajuanPinjaman $pengajuanPinjaman)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengajuanPinjaman  $pengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(PengajuanPinjaman $pengajuanPinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengajuanPinjaman  $pengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengajuanPinjaman $pengajuanPinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengajuanPinjaman  $pengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengajuanPinjaman $pengajuanPinjaman)
    {
        //
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        //Save Tbl Pengajuan Pinjaman
        $PengPinjUpdate = PengajuanPinjaman::find($id);
        // dd($PengPinjUpdate['kode_pengajuan_pinjaman']);
        $PengPinjUpdate->update([
            'approval_status'                => 'approved',
            'approval_name'                  => Auth::user()->username,
        ]);


        //Save Tbl Pinjaman//
        $tgl_pinj_approve = Carbon::now();
        // add 14 days to the current time
        $due_tgl_pengembalian = date('Y-m-d', strtotime('+14 days', strtotime($tgl_pinj_approve)));
        $PinjSave = Pinjaman::create([
            'tgl_pinjaman'              => $tgl_pinj_approve,
            'tgl_pengembalian'          => $due_tgl_pengembalian,
            'ket_pinjaman'              => '',
            'status_pinjam'             => 'DIPINJAM',
            'kode_ref_perpanjangan'     => $PengPinjUpdate['kode_pengajuan_pinjaman'],
            'pengajuan_pinjaman_id'     => $PengPinjUpdate['id'],
            'user_id'                   => Auth::user()->id,
        ]);
        $lastInsertid_Pinj = $PinjSave->id;


        //Save Tbl Detail Pinjaman
        $pengPinjDetail = DetailPengajuanPinjaman::where('pengajuan_pinjaman_id', $PengPinjUpdate['id'])->get();
        foreach ($pengPinjDetail as $key => $val) {
            # code...
            $DetPinjSave = DetailPinjaman::create([
                'pinjaman_id' => $lastInsertid_Pinj,
                'document_id' => $val->document_id,
            ]);

            $doc[] = $val->document_id;
        }

        //UPDATE Status Document "DIPINJAM"
        Document::whereIn("id", $doc)
            ->update([
                'status_doc' => 'DIPINJAM',
            ]);

        DB::commit();

        // echo 'Berhasil di Approve';
        return redirect('pengajuan_pinjamans')->with(['success' => 'Has been ' . $PengPinjUpdate['kode_pengajuan_pinjaman'] . ' Approved  successfull !']);
    }

    public function reject($id)
    {
        DB::beginTransaction();
        //Update Tbl Pengajuan Pinjaman
        $PengPinjUpdate = PengajuanPinjaman::find($id);
        $PengPinjUpdate->update([
            'approval_status'                => 'rejected',
            'approval_name'                  => Auth::user()->username,
        ]);

        DB::commit();


        return redirect('pengajuan_pinjamans')->with(['error' => 'Has been ' . $PengPinjUpdate['kode_pengajuan_pinjaman'] . ' Rejected !']);
    }

    public function document_tersedia(Request $request)
    {
        $document = Document::where('status_doc', 'TERSEDIA')->get();
        return response()->json($document);
    }
}
