<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vessel extends Model
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

    protected $table = "vessels";
    protected $primaryKey = "id";
    protected $fillable = [
        'vess_id',
        'vess_name',
        'vess_type',
        'vess_class',
        'vess_remarks',
        'created_at',
        'updated_at',
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
