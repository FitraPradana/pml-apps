<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FixedAssets extends Model
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

    // protected $guarded = ['id'];
    protected $table = "fixed_assets";
    protected $primaryKey = "id";
    protected $fillable = [
        'fixed_assets_number',
        'fixed_assets_name',
        'fixed_assets_group',
        'main_fixed_assets',
        'information3',
        'vessel_id',
        'acquisition_date',
        'net_book_value',
        'status_asset',
        'last_update_stock_take_date',
        'pic',
        'remarks_fixed_assets',
        'qr_code',
        'img_asset',
        'last_modified_name',
        'last_img_condition_stock_take',
        'site_id',
        'location_id',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
