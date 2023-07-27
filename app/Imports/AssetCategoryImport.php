<?php

namespace App\Imports;

use App\Models\AssetCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class AssetCategoryImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AssetCategory([
            //
            'asset_category_code'           => $row['asset_category_code'],
            'asset_category_name'           => $row['asset_category_name'],
            'remarks_asset_category'        => $row['remarks_asset_category'],
        ]);
    }

    public function rules(): array
    {
        return [
            // 'asset_category_code' => 'required|unique:locations',
        ];
    }
}
