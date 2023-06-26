<?php

namespace App\Exports;

use App\Models\Site;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiteExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Site::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Code Site',
            'Nama Site',
            'Remarks Site',
            'Created_at',
            'Updated_at',
            'Vessel',
        ];
    }
}
