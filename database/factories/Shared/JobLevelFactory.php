<?php

namespace Database\Factories\Shared;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobLevel>
 */
class JobLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $level = $this->faker->randomElement(['Asystent', 'Dyrektor', 'Kierownik', 'Pracownik', 'Stażysta', 'Praktykatn', 'Specjalista']);
        return [
            'level' => $level,
        ];
    }
}
