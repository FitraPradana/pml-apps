<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = "documents";
    protected $primaryKey = "id";
    protected $fillable = [
        'voucher',
        'last_settle_voucher',
        'last_settle_date',
        'jenis_doc',
        'description',
        'tgl_posting',
        'nominal',
        'kode_vendor',
        'nama_vendor',
        'pic',
        'tgl_terima_doc',
        'lemari',
        'lorong',
        'baris',
        'box',
        'no_folder',
        'upload_doc',
        'kelengkapan_doc',
        'ket_doc',
    ];
}
