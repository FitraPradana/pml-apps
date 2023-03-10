<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pengembalian.view');
    }


    public function json()
    {
        //
        $query = DB::table('pengembalians')
            ->join('pinjaman', 'pengembalians.pinjaman_id', '=', 'pinjaman.id')
            ->join('users', 'pengembalians.user_id', '=', 'users.id')
            ->select('pengembalians.*', 'users.username', 'pinjaman.kode_pinjaman')
            // ->where('approval_status', '!=', 'approved')
            ->orderByDesc('pengembalians.updated_at')
            ->get();
        return DataTables::of($query)
            ->addColumn('user_id', function ($data) {
                return $data->username;
            })
            ->addColumn('pinjaman_id', function ($data) {
                return $data->kode_pinjaman;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d M Y H:i:s');
            })
            ->addColumn('tgl_pengembalian', function ($data) {
                return Carbon::parse($data->tgl_pengembalian)->format('d M Y');
            })
            ->addColumn('due_tgl_pengembalian', function ($data) {
                return Carbon::parse($data->due_tgl_pengembalian)->format('d M Y');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengembalian $pengembalian)
    {
        //
    }
}
