<?php

namespace App\Imports;

use App\Models\FixedAssets;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class FixedAssetsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $qrcode = Str::random(20);

        return new FixedAssets([
            'fixed_assets_number'   => $row['fixed_assets_number'],
            'fixed_assets_name'     => $row['fixed_assets_name'],
            'fixed_assets_group' => $row['fixed_assets_group'],
            'main_fixed_assets' => $row['main_fixed_assets'],
            'information3' => $row['information3'],
            'vessel_id' => $row['vessel_id'],
            // 'acquisition_date' => $row['acquisition_date'],
            'net_book_value' => $row['net_book_value'],
            'status_asset' => 'general',
            // 'last_update_stock_take_date' => '',
            'pic' => $row['pic'],
            'remarks_fixed_assets' => $row['remarks_fixed_assets'],
            'qr_code' => $qrcode,
            // 'last_modified_name' => '',
        ]);
    }

    public function rules(): array
    {
        return [
            'fixed_assets_number' => 'required|unique:fixed_assets',
            // 'fixed_assets_name' => 'required',
            // 'fixed_assets_description' => 'required',
            // 'site_id' => 'required',
            // 'site_name' => 'required',
            // 'acquisition_date' => today(),
            // 'nbv' => 'required',
            // 'status' => 'general',
            // 'last_update' => 'required',
            // 'pic' => 'required',
            // 'remarks' => 'required',
        ];
    }
}
