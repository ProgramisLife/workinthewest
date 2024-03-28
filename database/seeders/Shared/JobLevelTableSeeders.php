<?php

namespace Database\Seeders\Shared;

use App\Models\Shared\JobLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class JobLevelTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = collect(['Asystent', 'Dyrektor', 'Prezes', 'Praktykant/Stażysta', 'Specjalista']);

        $levels->each(function ($levels) {
            JobLevel::firstOrCreate(['level' => $levels]);
        });
    }
}
