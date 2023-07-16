<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Alfa6661\AutoNumber\AutoNumberTrait;

class StockTakeTransaction extends Model
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

    protected $table = "stock_take_transactions";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_stock_take',
        'tgl_stock_take',
        'status_asset',
        'is_used',
        'pic',
        'remarks_stock_take',
        'last_img_condition_stock_take',
        'fixed_asset_id',
        'location_id',
        'user_id',
        'last_update_name',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function fixed_asset()
    {
        return $this->belongsTo(FixedAssets::class);
    }

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode_stock_take' => [
                'format' => 'BA/PML/' . date('m') . '/?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
