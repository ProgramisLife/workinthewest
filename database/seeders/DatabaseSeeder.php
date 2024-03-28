<?php

namespace Database\Seeders;

use Database\Factories\ArticleFactory;
use Database\Factories\JobFactory;
use Database\Seeders\Shared\CurrencyTableSeeder;
use Database\Seeders\Shared\JobCategoryTableSeeders;
use Database\Seeders\Shared\JobLevelTableSeeders;
use Database\Seeders\Shared\JobTypeTableSeeders;
use Database\Seeders\Shared\LanguageTableSeeders;
use Database\Seeders\Shared\SkillTableSeeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTableSeeders::class,
            JobCategoryTableSeeders::class,
            JobLevelTableSeeders::class,
            JobTypeTableSeeders::class,
            LanguageTableSeeders::class,
            CurrencyTableSeeder::class,
            SkillTableSeeders::class,
            ArticleFactory::class,
        ]);
    }
}
