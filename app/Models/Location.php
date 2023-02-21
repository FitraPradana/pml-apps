<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "locations";
    protected $primaryKey = "id";
    protected $fillable = [
        'location_code',
        'location_name',
        'location_remarks',
        'site_id',
        'room_id',
        'created_at',
        'updated_at',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
