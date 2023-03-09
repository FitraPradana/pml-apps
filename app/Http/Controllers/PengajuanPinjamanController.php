<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanPinjaman;
use App\Models\Document;
use App\Models\PengajuanPinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PengajuanPinjamanController extends Controller
{

    public function kode_otomatis()
    {
        // Kode Detail Pengajuan Pinjaman
        $thn = Carbon::now()->format('y');
        $cek = DetailPengajuanPinjaman::count();
        if ($cek == 0) {
            $urut = 1001;
            $kode_detail_pengajuan_pinjaman = 'DETPENGPINJ/' . $thn . '/' . $urut;
        } else {
            $ambil = DetailPengajuanPinjaman::all()->last();
            $urut = (int)substr($ambil->kode_detail_pengajuan_pinjaman, -4) + 1;
            $kode_detail_pengajuan_pinjaman = 'DETPENGPINJ/' . $thn . '/' . $urut;
        }

        return $kode_detail_pengajuan_pinjaman;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('ymd');
        $thn = Carbon::now()->format('y');
        $cek = PengajuanPinjaman::count();
        if ($cek == 0) {
            $urut = 1001;
            $nomer = 'PENGPINJ/' . $thn . '/' . $urut;
        } else {
            $ambil = PengajuanPinjaman::all()->last();
            $urut = (int)substr($ambil->kode_pengajuan_pinjaman, -4) + 1;
            $nomer = 'PENGPINJ/' . $thn . '/' . $urut;
        }


        // dd($nomer);


        //
        $document = Document::where('status_doc', 'TERSEDIA')->get();

        return view('pengajuan_pinjaman.view', compact('document', 'nomer'));
    }

    public function json()
    {
        //
        $query = DB::table('pengajuan_pinjaman')
            ->join('users', 'pengajuan_pinjaman.user_id', '=', 'users.id')
            ->select('pengajuan_pinjaman.*', 'users.username')
            ->orderByDesc('pengajuan_pinjaman.updated_at')
            ->get();
        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                return '
                    <div class="form group" align="center">
                    <a href="' . route('document.edit', $data->id) . '" class="edit btn btn-xs btn-info btn-flat btn-sm editAsset"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDoc"><i class="fa fa-trash"></i></a>
                    </div>
                ';
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
            ->rawColumns(['action'])
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
            // 'kode_pengajuan_pinjaman'   => $request->kode_pengajuan_pinjaman,
            'tgl_pengajuan_pinjaman'    => Carbon::now(),
            'ket_pengajuan_pinjaman'    => $request->ket_pengajuan_pinjaman,
            'approval_status'           => 'open',
            'user_id'                   => Auth::user()->id,
        ]);
        $lastInsertid_PengPinj = PengajuanPinjaman::where('kode_pengajuan_pinjaman', $PengPinjSave->kode_pengajuan_pinjaman)->first();



        //Save Tbl Detail Pengajuan Pinjaman
        foreach ($request->document_id as $key => $document_ids) {
            # code...
            $DetPengPinjSave = DetailPengajuanPinjaman::create([
                // 'kode_detail_pengajuan_pinjaman' => $kode_detail_pengajuan_pinjaman,
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
}
