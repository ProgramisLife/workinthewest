<?php

namespace Database\Seeders\Localisation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shared\Localisation\City;

class CityTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Austria
            [
                'id' => 1, 'city' => 'Eisenstadt', 'postal_code' => '7000', 'latitude' => 16.5333, 'longitude' => 47.85,
                'state_id' => 1,
            ],
            [
                'id' => 2, 'city' => 'Klagenfurt', 'postal_code' => '9020', 'latitude' => 14.305, 'longitude' => 46.6247,
                'state_id' => 2,
            ],
            [
                'id' => 3, 'city' => 'Wiener Neustadt', 'postal_code' => '2700', 'latitude' => 16.2382, 'longitude' => 47.815,
                'state_id' => 3,
            ],
            [
                'id' => 4, 'city' => 'Linz', 'postal_code' => '4010', 'latitude' => 14.2864, 'longitude' => 48.3064,
                'state_id' => 4,
            ],
            [
                'id' => 5, 'city' => 'Salzburg', 'postal_code' => '5020', 'latitude' => 13.0367, 'longitude' => 47.7994,
                'state_id' => 5,
            ],
            [
                'id' => 6, 'city' => 'Graz', 'postal_code' => '8010', 'latitude' => 15.436, 'longitude' => 47.07,
                'state_id' => 6,
            ],
            [
                'id' => 7, 'city' => 'Innsbruck', 'postal_code' => '6020', 'latitude' => 11.399, 'longitude' => 47.269,
                'state_id' => 7,
            ],
            [
                'id' => 8, 'city' => 'Dornbirn', 'postal_code' => '6850', 'latitude' => 9.7411, 'longitude' => 47.4144,
                'state_id' => 8,
            ],
            [
                'id' => 9, 'city' => 'Wiedeń', 'postal_code' => '1000', 'latitude' => 16.3721, 'longitude' => 48.2085,
                'state_id' => 9,
            ],

            // Dania
            [
                'id' => 10, 'city' => 'Odense', 'postal_code' => '', 'latitude' => 55.396, 'longitude' => 10.3908,
                'state_id' => 10,
            ],
            [
                'id' => 11, 'city' => 'Aalborg', 'postal_code' => '', 'latitude' => 57.048, 'longitude' => 9.9187,
                'state_id' => 11,
            ],
            [
                'id' => 12, 'city' => 'Aarhus', 'postal_code' => '', 'latitude' => 56.1629, 'longitude' => 10.2039,
                'state_id' => 12,
            ],
            [
                'id' => 13, 'city' => 'Kopenhaga', 'postal_code' => '', 'latitude' => 55.6761, 'longitude' => 12.5683,
                'state_id' => 13,
            ],
            [
                'id' => 14, 'city' => 'Roskilde', 'postal_code' => '', 'latitude' => 55.6415, 'longitude' => 12.0805,
                'state_id' => 14,
            ],

            // Niemcy
            [
                'id' => 15, 'city' => 'Stuttgart', 'postal_code' => '',
                'latitude' => 48.7758, 'longitude' => 9.1829,
                'state_id' => 15,
            ],
            [
                'id' => 16, 'city' => 'Monachium', 'postal_code' => '',
                'latitude' => 48.1351, 'longitude' => 11.5820,
                'state_id' => 16,
            ],
            [
                'id' => 17, 'city' => 'Berlin', 'postal_code' => '',
                'latitude' => 52.5200, 'longitude' => 13.4050,
                'state_id' => 17,
            ],
            [
                'id' => 18, 'city' => 'Poczdam', 'postal_code' => '',
                'latitude' => 52.4000, 'longitude' => 13.0667,
                'state_id' => 18,
            ],
            [
                'id' => 19, 'city' => 'Brema', 'postal_code' => '',
                'latitude' => 53.0793, 'longitude' => 8.8017,
                'state_id' => 19,
            ],
            [
                'id' => 20, 'city' => 'Hamburg', 'postal_code' => '',
                'latitude' => 53.5511, 'longitude' => 9.9937,
                'state_id' => 20,
            ],

            [
                'id' => 21, 'city' => 'Frankfurt nad Menem', 'postal_code' => '',
                'latitude' => 50.1109, 'longitude' => 8.6821,
                'state_id' => 21,
            ],
            [
                'id' => 22, 'city' => 'Schwerin', 'postal_code' => '',
                'latitude' => 53.6355, 'longitude' => 11.4013,
                'state_id' => 22,
            ],
            [
                'id' => 23, 'city' => 'Hanower ', 'postal_code' => '',
                'latitude' => 52.3759, 'longitude' => 9.7320,
                'state_id' => 23,
            ],
            [
                'id' => 24, 'city' => 'Kolonia', 'postal_code' => '',
                'latitude' => 50.9375, 'longitude' => 6.9603,
                'state_id' => 24,
            ],
            [
                'id' => 25, 'city' => 'Moguncja ', 'postal_code' => '',
                'latitude' => 49.9929, 'longitude' => 6.9969,
                'state_id' => 25,
            ],
            [
                'id' => 26, 'city' => 'Saarbrücken', 'postal_code' => '',
                'latitude' => 49.2401, 'longitude' => 6.994,
                'state_id' => 26,
            ],
            [
                'id' => 27, 'city' => 'Lipsk ', 'postal_code' => '',
                'latitude' => 51.3397, 'longitude' => 12.3731,
                'state_id' => 27,
            ],
            [
                'id' => 28, 'city' => 'Magdeburg ', 'postal_code' => '',
                'latitude' => 52.1205, 'longitude' => 11.6276,
                'state_id' => 28,
            ],
            [
                'id' => 29, 'city' => 'Kilonia', 'postal_code' => '',
                'latitude' => 54.3233, 'longitude' => 10.1228,
                'state_id' => 29,
            ],
            [
                'id' => 30, 'city' => 'Erfurt', 'postal_code' => '',
                'latitude' => 50.9848, 'longitude' => 11.0299,
                'state_id' => 30,
            ],

            // Polska
            [
                'id' => 31, 'city' => 'Wrocław', 'postal_code' => '',
                'latitude' => 51.1079, 'longitude' => 17.0385,
                'state_id' => 31,
            ],
            [
                'id' => 32, 'city' => 'Bydgoszcz', 'postal_code' => '',
                'latitude' => 53.1235, 'longitude' => 18.0084,
                'state_id' => 32,
            ],
            [
                'id' => 33, 'city' => 'Lublin', 'postal_code' => '',
                'latitude' => 51.9356, 'longitude' => 15.5064,
                'state_id' => 33,
            ],
            [
                'id' => 34, 'city' => 'Zielona Góra', 'postal_code' => '',
                'latitude' => 51.9356, 'longitude' => 15.5064,
                'state_id' => 34,
            ],
            [
                'id' => 35, 'city' => 'Łódź', 'postal_code' => '',
                'latitude' => 51.7592, 'longitude' => 19.4554,
                'state_id' => 35,
            ],
            [
                'id' => 36, 'city' => 'Kraków', 'postal_code' => '',
                'latitude' => 50.0647, 'longitude' => 19.9450,
                'state_id' => 36,
            ],
            [
                'id' => 37, 'city' => 'Warszawa', 'postal_code' => '',
                'latitude' => 52.2297, 'longitude' => 21.0122,
                'state_id' => 37,
            ],
            [
                'id' => 38, 'city' => 'Opole', 'postal_code' => '',
                'latitude' => 50.6755, 'longitude' => 17.9213,
                'state_id' => 38,
            ],
            [
                'id' => 39, 'city' => 'Rzeszów', 'postal_code' => '',
                'latitude' => 50.0412, 'longitude' => 21.9991,
                'state_id' => 39,
            ],
            [
                'id' => 40, 'city' => 'Białystok', 'postal_code' => '',
                'latitude' => 53.1325, 'longitude' => 23.1688,
                'state_id' => 40,
            ],
            [
                'id' => 41, 'city' => 'Gdańsk', 'postal_code' => '',
                'latitude' => 54.3520, 'longitude' => 18.6466,
                'state_id' => 41,
            ],
            [
                'id' => 42, 'city' => 'Katowice', 'postal_code' => '',
                'latitude' => 50.2649, 'longitude' => 19.0238,
                'state_id' => 42,
            ],
            [
                'id' => 43, 'city' => 'Kielce', 'postal_code' => '',
                'latitude' => 50.8661, 'longitude' => 20.6275,
                'state_id' => 43,
            ],
            [
                'id' => 44, 'city' => 'Olsztyn', 'postal_code' => '',
                'latitude' => 53.7799, 'longitude' => 20.4942,
                'state_id' => 44,
            ],
            [
                'id' => 45, 'city' => 'Poznań', 'postal_code' => '',
                'latitude' => 52.4064, 'longitude' => 16.9252,
                'state_id' => 45,
            ],
            [
                'id' => 46, 'city' => 'Szczecin', 'postal_code' => '',
                'latitude' => 53.4285, 'longitude' => 14.5528,
                'state_id' => 46,
            ],

            // Szwecja
            [
                'id' => 47, 'city' => 'Karlskrona', 'postal_code' => '',
                'latitude' => 56.1616, 'longitude' => 15.5866,
                'state_id' => 47,
            ],
            [
                'id' => 48, 'city' => 'Borlänge', 'postal_code' => '',
                'latitude' => 60.4847, 'longitude' => 15.4328,
                'state_id' => 48,
            ],
            [
                'id' => 49, 'city' => 'Visby', 'postal_code' => '',
                'latitude' => 57.6409, 'longitude' => 18.2960,
                'state_id' => 49,
            ],
            [
                'id' => 50, 'city' => 'Gävle', 'postal_code' => '',
                'latitude' => 60.6745, 'longitude' => 17.1417,
                'state_id' => 50,
            ],
            [
                'id' => 51, 'city' => 'Halmstad', 'postal_code' => '',
                'latitude' => 56.6745, 'longitude' => 12.8568,
                'state_id' => 51,
            ],
            [
                'id' => 52, 'city' => 'Östersund', 'postal_code' => '',
                'latitude' => 63.1792, 'longitude' => 14.6356,
                'state_id' => 52,
            ],
            [
                'id' => 53, 'city' => 'Jönköping', 'postal_code' => '',
                'latitude' => 57.7814, 'longitude' => 14.1562,
                'state_id' => 53,
            ],
            [
                'id' => 54, 'city' => 'Kalmar', 'postal_code' => '',
                'latitude' => 56.6636, 'longitude' => 16.3666,
                'state_id' => 54,
            ],
            [
                'id' => 55, 'city' => 'Välatitudejö', 'postal_code' => '',
                'latitude' => 56.8777, 'longitude' => 14.8090,
                'state_id' => 55,
            ],
            [
                'id' => 56, 'city' => 'Luleå', 'postal_code' => '',
                'latitude' => 65.5848, 'longitude' => 22.1567,
                'state_id' => 56,
            ],
            [
                'id' => 57, 'city' => 'Malmö', 'postal_code' => '',
                'latitude' => 55.6050, 'longitude' => 13.0038,
                'state_id' => 57,
            ],
            [
                'id' => 58, 'city' => 'Sztokholm', 'postal_code' => '',
                'latitude' => 59.3293, 'longitude' => 18.0686,
                'state_id' => 58,
            ],
            [
                'id' => 59, 'city' => 'Eskilstuna', 'postal_code' => '',
                'latitude' => 59.3666, 'longitude' => 16.5070,
                'state_id' => 59,
            ],
            [
                'id' => 60, 'city' => 'Uppsala', 'postal_code' => '',
                'latitude' => 59.8588, 'longitude' => 17.6389,
                'state_id' => 60,
            ],
            [
                'id' => 61, 'city' => 'Karlstad', 'postal_code' => '',
                'latitude' => 59.8588, 'longitude' => 17.6389,
                'state_id' => 61,
            ],
            [
                'id' => 62, 'city' => 'Umeå', 'postal_code' => '',
                'latitude' => 63.8258, 'longitude' => 20.2630,
                'state_id' => 62,
            ],
            [
                'id' => 63, 'city' => 'Sundsvall', 'postal_code' => '',
                'latitude' => 62.3908, 'longitude' => 17.3069,
                'state_id' => 63,
            ],
            [
                'id' => 64, 'city' => 'Göteborg', 'postal_code' => '',
                'latitude' => 57.7089, 'longitude' => 11.9746,
                'state_id' => 64,
            ],
            [
                'id' => 65, 'city' => 'Göteborg', 'postal_code' => '',
                'latitude' => 57.7089, 'longitude' => 11.9746,
                'state_id' => 65,
            ],
            [
                'id' => 66, 'city' => 'Örebro', 'postal_code' => '',
                'latitude' => 59.2741, 'longitude' => 15.2066,
                'state_id' => 66,
            ],

            // Wielka Brytania
            [
                'id' => 67, 'city' => 'Southampton', 'postal_code' => '',
                'latitude' => 50.90395, 'longitude' => -1.40428,
                'state_id' => 67,
            ],
            [
                'id' => 68, 'city' => 'Bristol', 'postal_code' => '',
                'latitude' => 51.4552300, 'longitude' => -2.5966500,
                'state_id' => 68,
            ],
            [
                'id' => 69, 'city' => 'Luton', 'postal_code' => '',
                'latitude' => 51.87967, 'longitude' =>  -0.41748,
                'state_id' => 69,
            ],
            [
                'id' => 70, 'city' => 'London', 'postal_code' => '',
                'latitude' => 51.509865, 'longitude' =>  -0.118092,
                'state_id' => 70,
            ],
            [
                'id' => 71, 'city' => 'Leicester', 'postal_code' => '',
                'latitude' => 51.506164642, 'longitude' =>  -0.124832834,
                'state_id' => 71,
            ],
            [
                'id' => 72, 'city' => 'Birmingham', 'postal_code' => '',
                'latitude' => 52.489471, 'longitude' =>  -1.898575,
                'state_id' => 72,
            ],
            [
                'id' => 73, 'city' => 'Kingston upon Hull', 'postal_code' => '',
                'latitude' => 53.767750, 'longitude' =>  -0.335827,
                'state_id' => 73,
            ],
            [
                'id' => 74, 'city' => 'Newcastle upon Tyne', 'postal_code' => '',
                'latitude' => 54.966667, 'longitude' =>  -1.600000,
                'state_id' => 74,
            ],
            [
                'id' => 75, 'city' => 'Liverpool', 'postal_code' => '',
                'latitude' => 53.400002, 'longitude' =>  -2.983333,
                'state_id' => 75,
            ],
        ];

        foreach ($cities as $city) {
            City::create([
                'city' => $city['city'],
                'postal_code' => $city['postal_code'],
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
                'state_id' => $city['state_id'],
            ]);
        }
    }
}
