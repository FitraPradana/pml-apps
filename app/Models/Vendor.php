<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vendor extends Model
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

    protected $table = "vendors";
    protected $primaryKey = "id";
    protected $fillable = [
        'accountnum',
        'vend_name',
        'vend_address',
        'vend_phone',
        'vend_remarks',
        'created_at',
        'updated_at',
    ];
}
