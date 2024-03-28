<?php

namespace Database\Factories\Shared;

use App\Models\Shared\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CurrnecyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Currency::class;

    public function definition(): array
    {
        $currency = $this->faker->randomElement(['PLN', 'EUR', 'USD']);
        return [
            'currency' => $currency,
        ];
    }
}
