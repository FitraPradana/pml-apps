<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

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
