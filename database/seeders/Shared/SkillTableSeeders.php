<?php

namespace Database\Seeders\Shared;

use App\Models\Shared\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class SkillTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skill = collect(['Programowanie', 'Budowlanka', 'Sprzątanie']);

        $skill->each(function ($skill) {
            Skill::firstOrCreate(['skill' => $skill]);
        });
    }
}
