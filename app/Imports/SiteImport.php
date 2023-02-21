<?php

namespace App\Imports;

use App\Models\Room;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiteImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $room_vessel = Room::where('room_code','VESSEL')->first();
        $room_id = $room_vessel->id;
        return new Site([
            // 'room_id'   => $row['room_id'],
            'room_id'   => $room_id,
            'vessel_id'   => 5,
            // 'site_code'   => $row['site_code'],
            'site_name'   => $row['site_name'],
            'remarks_site'   => $row['remarks_site'],
        ]);
    }

    public function rules(): array
    {
        return [
            'site_code' => 'required|unique:sites',
        ];
    }
}
