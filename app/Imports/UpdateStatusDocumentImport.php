<?php

namespace App\Imports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UpdateStatusDocumentImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $doc = Document::where('voucher', $row['voucher'])->first();
        // if product exists and the value also exists
        if ($doc) {
            $doc->update([
                'jenis_doc' => $row['jenis_doc'],
                'pic' => $row['pic'],
                // 'tgl_terima_doc' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_terima_doc']),
                'lemari' => $row['lemari'],
                'lorong' => $row['lorong'],
                'baris' => $row['baris'],
                'box' => $row['box'],
                'ket_doc' => $row['ket_doc'],
                'status_doc' => 'TERSEDIA',
            ]);

            return $doc;
        }
    }
}
