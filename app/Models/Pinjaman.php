<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pinjaman extends Model
{
    use HasFactory;
    use AutoNumberTrait;

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

    protected $table = "pinjaman";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_pinjaman',
        'tgl_pinjaman',
        'tgl_pengembalian',
        'ket_pinjaman',
        'status_pinjam',
        'kode_ref_perpanjangan',
        'created_at',
        'updated_at',
        'user_id',
        'pengajuan_pinjaman_id',
    ];

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode_pinjaman' => [
                'format' => 'PINJ/' . date('y') . '/?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
