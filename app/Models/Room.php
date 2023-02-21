<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Site;

class Room extends Model
{
    use HasFactory;


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
