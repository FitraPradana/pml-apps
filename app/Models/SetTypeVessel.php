<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetTypeVessel extends Model
{
    use HasFactory;

    protected $connection = "mysql-vms-prod";
    protected $table = "settype_tugbarge";
    protected $db = "";


    protected $fillable = [
        'month',
        'year',
        'first_date',
        'tug',
        'barge',
        'is_active',
        'tug_power',
        'barge_capacity',
        'barge_capacity',
        'voyage_number',
        'created_date',
        'created_user',
        'ip_user_updated',
    ];



    // public function get_vessel()
    // {
    // }
}
