<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Document extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->getKey() == null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

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
