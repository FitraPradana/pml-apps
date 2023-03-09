<?php

namespace App\Http\Controllers;

use App\Models\DetailPengembalian;
use App\Models\DetailPinjaman;
use App\Models\Document;
use App\Models\Pengembalian;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pinjaman.view');
    }

    public function json()
    {
        //
        $query = DB::table('pinjaman')
            ->join('pengajuan_pinjaman', 'pinjaman.pengajuan_pinjaman_id', '=', 'pengajuan_pinjaman.id')
            ->join('users', 'pinjaman.user_id', '=', 'users.id')
            ->select('pinjaman.*', 'users.username')
            // ->where('approval_status', '!=', 'approved')
            ->orderByDesc('pinjaman.kode_pinjaman')
            ->get();
        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                if ($data->status_pinjam == 'DIPINJAM') {

                    return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('pinjaman.perpanjang', $data->id) . '" style="color: blue;">Perpanjang</a>
                                <a class="dropdown-item" href="' . route('pinjaman.kembalikan', $data->id) . '" style="color: red;">Kembalikan</a>
                            </div>
                    </div>

                    ';
                }
            })
            ->editColumn('status_pinjam', function ($edit_status) {
                if ($edit_status->status_pinjam == 'DIPINJAM') {
                    return '<span class="badge bg-inverse-warning">DIPINJAM</span>';
                } elseif ($edit_status->status_pinjam == 'DIPERPANJANG') {
                    return '<span class="badge bg-inverse-info">DIPERPANJANG</span>';
                } elseif ($edit_status->status_pinjam == 'DIKEMBALIKAN') {
                    return '<span class="badge bg-inverse-success">DIKEMBALIKAN</span>';
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
            ->addColumn('tgl_pinjaman', function ($data) {
                return Carbon::parse($data->tgl_pinjaman)->format('d M Y');
            })
            ->addColumn('tgl_pengembalian', function ($data) {
                return Carbon::parse($data->tgl_pengembalian)->format('d M Y');
            })
            ->rawColumns(['action', 'status_pinjam'])
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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }

    public function perpanjang($id)
    {
        DB::beginTransaction();
        //Update Tbl Pinjaman Lama
        $PinjLamaUpdate = Pinjaman::find($id);
        $PinjLamaUpdate->update([
            'status_pinjam'                  => 'DIPERPANJANG',
            'ket_pinjaman'                   => 'Peminjaman di Perpanjang',
        ]);


        //Update Tbl Pinjaman
        $tgl_pinj_perpanjang = Carbon::now();
        // add 14 days to the current time
        $due_tgl_pengembalian = date('Y-m-d', strtotime('+14 days', strtotime($tgl_pinj_perpanjang)));
        $PinjSave = Pinjaman::create([
            'tgl_pinjaman'              => $tgl_pinj_perpanjang,
            'tgl_pengembalian'          => $due_tgl_pengembalian,
            'ket_pinjaman'              => '',
            'status_pinjam'             => 'DIPINJAM',
            'kode_ref_perpanjangan'     => $PinjLamaUpdate['kode_pinjaman'],
            'pengajuan_pinjaman_id'     => $PinjLamaUpdate['pengajuan_pinjaman_id'],
            'user_id'                   => $PinjLamaUpdate['user_id'],
        ]);
        $lastInsertid_Pinj = $PinjSave->id;

        //Save Tbl Detail Pinjaman
        $PinjDetail = DetailPinjaman::where('pinjaman_id', $PinjLamaUpdate['id'])->get();
        foreach ($PinjDetail as $key => $val) {
            # code...
            $DetPinjSave = DetailPinjaman::create([
                'pinjaman_id' => $lastInsertid_Pinj,
                'document_id' => $val->document_id,
            ]);
        }

        DB::commit();


        return redirect('pinjamans')->with(['success' => 'Kode Pinjam ' . $PinjLamaUpdate['kode_pinjaman'] . ' Berhasil di Perpanjang !']);
    }

    public function kembalikan($id)
    {
        DB::beginTransaction();
        //Update Tbl Pinjaman Lama
        $PinjLamaUpdate = Pinjaman::find($id);
        $PinjLamaUpdate->update([
            'status_pinjam'                  => 'DIKEMBALIKAN',
            'ket_pinjaman'                   => 'Peminjaman di KEMBALIKAN',
        ]);

        //Update Tbl Pengembalian
        $tgl_pengembalian = Carbon::now();
        $PengembalianSave = Pengembalian::create([
            'tgl_pengembalian'              => $tgl_pengembalian,
            'due_tgl_pengembalian'          => $PinjLamaUpdate['tgl_pengembalian'],
            'ket_pengembalian'              => '',
            'pinjaman_id'                   => $PinjLamaUpdate['id'],
            'user_id'                       => $PinjLamaUpdate['user_id'],
        ]);
        $lastInsertid_Pengembalian = $PengembalianSave->id;


        //Save Tbl Detail Pengembalian
        $PinjDetail = DetailPinjaman::where('pinjaman_id', $PinjLamaUpdate['id'])->get();
        foreach ($PinjDetail as $key => $val) {
            # code...
            $DetPengembalianSave = DetailPengembalian::create([
                'pengembalian_id' => $lastInsertid_Pengembalian,
                'document_id' => $val->document_id,
            ]);

            $doc[] = $val->document_id;
        }

        //UPDATE Status Document "DIPINJAM"
        Document::whereIn("id", $doc)
            ->update([
                'status_doc' => 'TERSEDIA',
            ]);


        DB::commit();

        return redirect('pinjamans')->with(['success' => 'Kode Pinjam ' . $PinjLamaUpdate['kode_pinjaman'] . ' Berhasil di Kembalikan !']);
    }
}
