<?php

namespace Database\Seeders\Shared;

use App\Models\Shared\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class JobTypeTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = collect(['Część Etatu', 'Freelancer', 'Kontrakt', 'Pełny etat', 'Praca czasowa', 'Praktyka', 'Wolontariat']);

        $type->each(function ($type) {
            JobType::firstOrCreate(['type' => $type]);
        });
    }
}
