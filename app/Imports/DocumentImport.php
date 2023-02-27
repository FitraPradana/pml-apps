<?php

namespace App\Imports;

use App\Models\Document;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DocumentImport implements ToModel, WithHeadingRow //, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Document([
            //
            'tgl_posting'           => Carbon::parse($row['tgl_posting']),
            'voucher'               => $row['voucher'],
            'last_settle_voucher'   => $row['last_settle_voucher'],
            'last_settle_date'      => Carbon::parse($row['last_settle_date']),
            'description'           => $row['description'],
            'nominal'               => $row['nominal'],
            'kode_vendor'           => $row['kode_vendor'],
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         'fixed_assets_number' => 'required|unique:fixed_assets',
    //         // 'fixed_assets_name' => 'required',
    //         // 'fixed_assets_description' => 'required',
    //         // 'site_id' => 'required',
    //         // 'site_name' => 'required',
    //         // 'acquisition_date' => today(),
    //         // 'nbv' => 'required',
    //         // 'status' => 'general',
    //         // 'last_update' => 'required',
    //         // 'pic' => 'required',
    //         // 'remarks' => 'required',
    //     ];
    // }
}
