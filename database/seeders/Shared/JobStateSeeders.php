<?php

namespace Database\Seeders\Shared;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Shared\JobState;
use Illuminate\Database\Seeder;

class JobStateSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = collect(['praca zdalna','praca hybrydowa', 'praca stacjonarna', 'praca zmianowa']);

        $state->each(function ($state) {
            JobState::firstOrCreate(['name' => $state]);
        });
    }
}
