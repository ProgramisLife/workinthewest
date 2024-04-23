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
        $currency = collect(['PLN', 'EUR', 'USD', 'CZK', 'UAH', 'GBP', 'CHF', 'NOK', 'SEK', 'DKK', 'HUF', 'RON', 'BGN', 'HRK', 'RSD', 'ISK', 'TRY', 'RUB', 'BYN', 'GEL']);

        $currency->each(function ($currency) {
            Currency::firstOrCreate(['currency' => $currency]);
        });
    }
}
