<?php

namespace Database\Seeders\Shared;

use Illuminate\Database\Seeder;
use App\Models\Shared\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency = collect(['PLN', 'EUR', 'USD', 'CZK', 'UAH']);

        $currency->each(function ($currency) {
            Currency::firstOrCreate(['currency' => $currency]);
        });
    }
}
