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
        $language = collect(['Polski', 'Angielski', 'Niemiecki', 'Francuski', 'Hiszpański', 'Włoski', 'Portugalski', 'Holenderski', 'Szwedzki', 'Norweski', 'Duński', 'Finlandzki', 'Rosyjski', 'Grecki', 'Czeski', 'Słowacki', 'Węgierski', 'Bułgarski', 'Rumuński', 'Litewski', 'Łotewski', 'Estoński', 'Chorwacki', 'Słoweński', 'Serbski', 'Macedoński', 'Albański', 'Maltański', 'Islandzki', 'Irlandzki', 'Szkocki', 'Walijski', 'Bretoński', 'Baskijski', 'Kataloński', 'Galicyjski', 'Białoruski', 'Ukraiński', 'Moldawski', 'Luksemburski', 'Lichtensteiński', 'Andorski', 'Monakijski', 'Maltański', 'Walijski', 'Baskijski', 'Kataloński', 'Galicyjski', 'Białoruski', 'Ukraiński', 'Moldawski']);

        $language->each(function ($language) {
            Language::firstOrCreate(['language' => $language]);
        });
    }
}
