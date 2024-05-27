<?php

namespace Database\Seeders;

use Database\Seeders\Shared\CurrencyTableSeeder;
use Database\Seeders\Shared\JobCategoryTableSeeders;
use Database\Seeders\Shared\JobLevelTableSeeders;
use Database\Seeders\Shared\JobTypeTableSeeders;
use Database\Seeders\Shared\LanguageTableSeeders;
use Database\Seeders\Shared\SkillTableSeeders;
use Database\Seeders\Shared\JobStateSeeders;
use Database\Seeders\Localisation\CountryTableSeeders;
use Database\Seeders\Localisation\StateTableSeeders;
use Database\Seeders\Localisation\CityTableSeeders;
use Database\Seeders\Shared\AccommodationCategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JobCategoryTableSeeders::class,
            JobLevelTableSeeders::class,
            JobTypeTableSeeders::class,
            LanguageTableSeeders::class,
            CurrencyTableSeeder::class,
            SkillTableSeeders::class,
            CountryTableSeeders::class,
            StateTableSeeders::class,
            CityTableSeeders::class,
            JobStateSeeders::class,
            AccommodationCategorySeeder::class,
        ]);
    }
}
