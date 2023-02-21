<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = "departments";
    protected $primaryKey = "id";
    protected $fillable = [
        'dept_code',
        'dept_name',
        'remarks_dept',
    ];
}
