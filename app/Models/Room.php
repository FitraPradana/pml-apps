<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Site;
use Illuminate\Support\Str;

class Room extends Model
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

    protected $table = "rooms";
    protected $primaryKey = "id";
    protected $fillable = [
        'room_code',
        'room_name',
        'remarks_room',
        'created_at',
        'updated_at',
    ];


    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
