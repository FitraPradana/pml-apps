<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new User([
            'personnel_number'   => $row['personnel_number'],
            'full_name'         => $row['full_name'],
            'email'             => $row['email'],
            'username'          => $row['username'],
            'password'          => Hash::make('PML@2023'),
            // 'gender'            => $row['gender'],
            'type'              => $row['type'],
            'roles'             => $row['roles'],
            'remarks_user'      => $row['remarks_user'],
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|unique:users',
        ];
    }
}
