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
        $categories = collect(['Administracja', 'Budownictwo', 'IT', 'Produkcja', 'IT - Rozwój oprogramowania']);

        $categories->each(function ($category) {
            JobCategory::firstOrCreate(['category' => $category]);
        });
    }
}
