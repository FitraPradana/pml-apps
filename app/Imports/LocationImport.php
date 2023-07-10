<?php

namespace App\Imports;

use App\Models\Location;
use App\Models\Room;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class LocationImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $site_id = $row['site_id'];
        $room_id = $row['room_id'];

        $site = Site::where('site_code', $site_id)->first();
        $room = Room::where('room_code', $room_id)->first();

        return new Location([
            'site_id'           => $site['id'],
            'room_id'           => $room['id'],
            'location_code'     => $row['location_code'],
            'location_name'     => $row['location_name'],
            'location_remarks'  => $row['location_remarks'],
        ]);
    }

    public function rules(): array
    {
        return [
            'location_code' => 'required|unique:locations',
        ];
    }
}
