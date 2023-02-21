<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees";
    protected $primaryKey = "id";
    protected $fillable = [
        'personel_number',
        'name_search',
        'employee_name',
        'birthday',
        'phone',
        'address',
        'gender',
        'user_id',
        'department_id',
    ];


}
