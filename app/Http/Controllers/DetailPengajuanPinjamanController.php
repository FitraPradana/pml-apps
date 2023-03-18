<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanPinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DetailPengajuanPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pengajuan_pinjaman.detail.view');
    }

    public function json($id_pengpinj)
    {
        // if ($id_peng_pinj == 'empty') {
        //     $detail = DetailPengajuanPinjaman::orderBy('updated_at', 'desc')->get();
        // } else {
        //     // $detail = DetailPengajuanPinjaman::orderBy('updated_at', 'desc')->get();
        //     $detail = DetailPengajuanPinjaman::where('pengajuan_pinjaman_id', $id_peng_pinj)
        //         ->orderBy('updated_at', 'desc')->get();
        // }

        $detail = DetailPengajuanPinjaman::where('pengajuan_pinjaman_id', $id_pengpinj)
            ->orderBy('updated_at', 'desc')->get();
        // $detail = DetailPengajuanPinjaman::orderBy('updated_at', 'desc')->get();

        // return Datatables::of(User::all())
        return DataTables::of($detail)
            ->addColumn('action', function ($data) {
                return '';
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('kode_pengajuan_pinjaman', function ($data) {
                return $data->pengajuan_pinjaman->kode_pengajuan_pinjaman;
            })
            ->addColumn('voucher', function ($data) {
                return '' . $data->document->voucher . ' || ' . $data->document->vendor->vend_name . ' ';
            })
            ->rawColumns(['action', 'voucher'])
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPengajuanPinjaman  $detailPengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPengajuanPinjaman $detailPengajuanPinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailPengajuanPinjaman  $detailPengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPengajuanPinjaman $detailPengajuanPinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailPengajuanPinjaman  $detailPengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPengajuanPinjaman $detailPengajuanPinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPengajuanPinjaman  $detailPengajuanPinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPengajuanPinjaman $detailPengajuanPinjaman)
    {
        //
    }
}
