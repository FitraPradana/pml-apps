<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LogTransFixedAssets extends Model
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

    protected $table = "log_trans_fixed_assets";
    protected $primaryKey = "id";
    protected $fillable = [
        'log_transdate',
        'remarks_log',
        'last_img_condition_stock_take',
        'last_update_name',
        'ip_user_update',
        'type_update',
        'status_asset',
        'is_used',
        'fixed_asset_id',
        'location_id',
        'user_id',
    ];
}
