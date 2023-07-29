<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
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

    protected $table = "employees";
    protected $primaryKey = "id";
    protected $fillable = [
        'emp_accountnum',
        'emp_name',
        'emp_email',
        'emp_phone',
        'emp_address',
        'emp_remarks',
        'user_id',
        'department_id',

    ];
}
