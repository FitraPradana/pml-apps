<?php

namespace App\Exports;

use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rooms = DB::table('rooms')
            ->select('rooms.room_code', 'rooms.room_name', 'rooms.remarks_room')
            ->get();
        return $rooms;
    }

    public function headings(): array
    {
        return [
            // 'id',
            'room_code',
            'room_name',
            'remarks_room',
            // 'Created_at',
            // 'Updated_at'
        ];
    }
}
