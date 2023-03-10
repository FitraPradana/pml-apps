<?php

namespace App\Imports;

use App\Models\Document;
use App\Models\Vendor;
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

        $vend = Vendor::where('accountnum', $row['kode_vendor'])->first();

        return new Document([
            //
            'tgl_posting'           => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_posting']),
            'voucher'               => $row['voucher'],
            'invoice'               => $row['invoice'],
            'status_doc'            => 'GENERAL',
            'last_settle_voucher'   => $row['last_settle_voucher'],
            'last_settle_date'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['last_settle_date']),
            'description'           => $row['description'],
            'nominal'               => $row['nominal'],
            'vendor_id'             => $vend->id,
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         'voucher' => 'required|unique:documents',
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
