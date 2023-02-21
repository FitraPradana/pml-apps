<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedAssets extends Model
{
    use HasFactory;

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
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
