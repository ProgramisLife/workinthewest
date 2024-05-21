<?php

namespace Database\Seeders\Localisation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shared\Localisation\City;

class CityTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [      
            [
                'id' => 1, 'city' => 'Poznań',
                'latitude' => 52.4064, 'longitude' => 16.9252,
                'state_id' => 2892,
            ],
        ];

        foreach ($cities as $city) {
            City::create([
                'city' => $city['city'],
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
                'state_id' => $city['state_id'],
            ]);
        }
    }
}
