<?php

namespace Database\Seeders\Shared;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shared\AccommodationCategory;

class AccommodationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accommodationCategory = collect(['Do kupienia', 'Wynajem']);

        $accommodationCategory->each(function ($accommodationCategory) {
            AccommodationCategory::firstOrCreate(['name' => $accommodationCategory]);
        });
    }
}
