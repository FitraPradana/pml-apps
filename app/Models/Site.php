<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

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

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
