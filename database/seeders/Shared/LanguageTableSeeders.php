<?php

namespace Database\Seeders\Shared;

use App\Models\Shared\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class LanguageTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = collect(['angielski', 'francuski', 'niemiecki', 'włoski']);

        $language->each(function ($language) {
            Language::firstOrCreate(['language' => $language]);
        });
    }
}
