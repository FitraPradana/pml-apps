<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }


    public function headings():array{
        return[
            'ID',
            'Personnel Number',
            'Full Name',
            'Email',
            'Username',
            'Birthday',
            'Phone',
            'Address',
            'Gender',
            'Type',
            'Roles',
            'Images',
            'Remarks',
            'Created_at',
            'Updated_at'
        ];
    }
}
