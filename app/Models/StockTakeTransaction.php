<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StockTakeTransaction extends Model
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

    protected $table = "stock_take_transactions";
    protected $primaryKey = "id";
    protected $fillable = [
        'tgl_stock_take',
        'status_asset',
        'pic',
        'remarks_stock_take',
        'last_img_condition_stock_take',
        'fixed_asset_id',
        'location_id',
        'last_update_name',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function fixed_asset()
    {
        return $this->belongsTo(FixedAssets::class);
    }
}
