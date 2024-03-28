<?php

namespace Database\Factories\Shared;

use App\Models\Shared\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobCategory>
 */
class JobCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = JobCategory::class;

    public function definition(): array
    {
        $category = $this->faker->randomElement(['Administracja', 'Budownictwo', 'IT', 'Produkcja', 'IT - Rozwój oprogramowania']);
        return [
            'category' => $category,
        ];
    }
}
