<?php

namespace Database\Seeders\Localisation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shared\Localisation\Country;

class CountryTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesData = [
            ['id' => 1, 'country' => 'Albania', 'shortcut' => 'AL'],
            ['id' => 2, 'country' => 'Andora', 'shortcut' => 'AD'],
            ['id' => 3, 'country' => 'Austria', 'shortcut' => 'AT'],
            ['id' => 4, 'country' => 'Belgia', 'shortcut' => 'BE'],
            ['id' => 5, 'country' => 'Białoruś', 'shortcut' => 'BY'],
            ['id' => 6, 'country' => 'Bośnia i Hercegowina', 'shortcut' => 'BA'],
            ['id' => 7, 'country' => 'Bułgaria', 'shortcut' => 'BG'],
            ['id' => 8, 'country' => 'Chorwacja', 'shortcut' => 'HR'],
            ['id' => 9, 'country' => 'Czarnogóra', 'shortcut' => 'ME'],
            ['id' => 10, 'country' => 'Czechy', 'shortcut' => 'CZ'],
            ['id' => 11, 'country' => 'Dania', 'shortcut' => 'DK'],
            ['id' => 12, 'country' => 'Estonia', 'shortcut' => 'EE'],
            ['id' => 13, 'country' => 'Finlandia', 'shortcut' => 'FI'],
            ['id' => 14, 'country' => 'Francja', 'shortcut' => 'FR'],
            ['id' => 15, 'country' => 'Grecja', 'shortcut' => 'GR'],
            ['id' => 16, 'country' => 'Hiszpania', 'shortcut' => 'ES'],
            ['id' => 17, 'country' => 'Holandia', 'shortcut' => 'NL'],
            ['id' => 18, 'country' => 'Irlandia', 'shortcut' => 'IE'],
            ['id' => 19, 'country' => 'Islandia', 'shortcut' => 'IS'],
            ['id' => 20, 'country' => 'Kazachstan', 'shortcut' => 'KZ'],
            ['id' => 21, 'country' => 'Liechtenstein', 'shortcut' => 'LI'],
            ['id' => 22, 'country' => 'Litwa', 'shortcut' => 'LT'],
            ['id' => 23, 'country' => 'Luksemburg', 'shortcut' => 'LU'],
            ['id' => 24, 'country' => 'Łotwa', 'shortcut' => 'LV'],
            ['id' => 25, 'country' => 'Macedonia Północna', 'shortcut' => 'MK'],
            ['id' => 26, 'country' => 'Malta', 'shortcut' => 'MT'],
            ['id' => 27, 'country' => 'Mołdawia', 'shortcut' => 'MD'],
            ['id' => 28, 'country' => 'Monako', 'shortcut' => 'MC'],
            ['id' => 29, 'country' => 'Niemcy', 'shortcut' => 'DE'],
            ['id' => 30, 'country' => 'Norwegia', 'shortcut' => 'NO'],
            ['id' => 31, 'country' => 'Polska', 'shortcut' => 'PL'],
            ['id' => 32, 'country' => 'Portugalia', 'shortcut' => 'PT'],
            ['id' => 33, 'country' => 'Rosja', 'shortcut' => 'RU'],
            ['id' => 34, 'country' => 'Rumunia', 'shortcut' => 'RO'],
            ['id' => 35, 'country' => 'San Marino', 'shortcut' => 'SM'],
            ['id' => 36, 'country' => 'Serbia', 'shortcut' => 'RS'],
            ['id' => 37, 'country' => 'Słowacja', 'shortcut' => 'SK'],
            ['id' => 38, 'country' => 'Słowenia', 'shortcut' => 'SI'],
            ['id' => 39, 'country' => 'Szwajcaria', 'shortcut' => 'CH'],
            ['id' => 40, 'country' => 'Szwecja', 'shortcut' => 'SE'],
            ['id' => 41, 'country' => 'Turcja', 'shortcut' => 'TR'],
            ['id' => 42, 'country' => 'Ukraina', 'shortcut' => 'UA'],
            ['id' => 43, 'country' => 'Watykan', 'shortcut' => 'VA'],
            ['id' => 44, 'country' => 'Węgry', 'shortcut' => 'HU'],
            ['id' => 45, 'country' => 'Wielka Brytania', 'shortcut' => 'GB'],
            ['id' => 46, 'country' => 'Włochy', 'shortcut' => 'IT'],
        ];

        foreach ($countriesData as $countryData) {
            Country::create([
                'id' => $countryData['id'],
                'country' => $countryData['country'],
                'shortcut' => $countryData['shortcut'],
            ]);
        }
    }
}
