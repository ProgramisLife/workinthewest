<?php

namespace Database\Seeders\Shared;

use App\Models\Shared\JobCategory;
use Illuminate\Database\Seeder;

class JobCategoryTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(['Administracja', 'Bankowość', ' Badania i rozwój',
        'BHP / Ochrona środowiska', 'Budownictwo', 'Call Center', 'Dobroczynność / praca socjalna',
        'Call Center', 'Dobroczynność / praca socjalna', 'IT', 'Doradztwo - Konsulting', 'Edukacja / Szkolenia',
        'Energetyka', 'Finanse / Ekonomia', 'Franczyza / Własny biznes', 'Gastronomia / Catering', 'Hotelarstwo / Turystyka',
        'Human Resources / Zasoby ludzkie', 'Inne', 'Inżynieria', 'IT - Administracja', 'IT - Rozwój oprogramowania',
        'Kontrola jakości', 'Marketing', 'Media / Dziennikarstwo / Gazeta', 'Nieruchomości', 'Obsługa klienta',
        'Opieka zdrowotna', 'Praca fizyczna', 'Prawo', 'Produkcja', 'Reklama / Grafika / Fotografia', 'Sektor publiczny',
        'Sprzedaż', 'Sztuka / Rozrywka', 'Transport / Spedycja', 'Ubezpieczenia', ' Zdrowie / Uroda / Rekreacja'
        ]);

        $categories->each(function ($category) {
            JobCategory::firstOrCreate(['category' => $category]);
        });
    }
}
