<?php

namespace Database\Seeders;

use App\Models\FixedAssets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixedAssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asset = [
            'fixed_assets_number' => 'test',
            'fixed_assets_name' => 'test',
            'fixed_assets_description' => 'test',
            'site_id' => 'test',
            'site_name' => 'test',
            // 'acquisition_date' => '10-10-2022',
            'nbv' => 'test',
            'status' => 'general',
            'last_update' => 'test',
            'pic' => 'test',
            'remarks' => 'test',
            // 'created_at' => '10/10/2022',
            // 'updated_at' => '10/10/2022',
        ];

        FixedAssets::insert($asset);
    }
}
