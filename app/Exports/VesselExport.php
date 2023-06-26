<?php

namespace App\Exports;

use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VesselExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Vessel::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'ID Vessel',
            'Nama Vessel',
            'Type Vessel',
            'Class Vessel',
            'Remarks Vessel',
            'Created_at',
            'Updated_at'
        ];
    }
}
