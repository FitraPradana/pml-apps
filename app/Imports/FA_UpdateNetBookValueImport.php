<?php

namespace App\Imports;

use App\Models\FixedAssets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FA_UpdateNetBookValueImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fa = FixedAssets::where('fixed_assets_number', $row['fixed_assets_number'])->first();
        // if product exists and the value also exists
        if ($fa){
            $fa->update([
                'net_book_value'=>$row['net_book_value']
            ]);

            return $fa;
        }
    }
}
