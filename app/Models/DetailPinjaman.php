<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Alfa6661\AutoNumber\AutoNumberTrait;

class DetailPinjaman extends Model
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

    protected $table = "detail_pinjaman";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_detail_pinjaman',
        'created_at',
        'updated_at',
        'pinjaman_id',
        'document_id',
    ];

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode_detail_pinjaman' => [
                'format' => 'DETPINJ/' . date('y') . '/?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
