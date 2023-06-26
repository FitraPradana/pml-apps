<?php

namespace App\Exports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Location::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Code Location',
            'Nama Location',
            'Remarks Location',
            'Site',
            'Room',
            'Created_at',
            'Updated_at'
        ];
    }
}
