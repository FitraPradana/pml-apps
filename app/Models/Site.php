<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
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

    protected $table = "sites";
    protected $primaryKey = "id";
    protected $fillable = [
        'site_code',
        'site_name',
        'remarks_site',
        'created_at',
        'updated_at',
        'vessel_id',
    ];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // public function vessel()
    // {
    //     return $this->belongsTo(Vessel::class);
    // }

    // public function locations()
    // {
    //     return $this->hasMany(Location::class);
    // }
}
