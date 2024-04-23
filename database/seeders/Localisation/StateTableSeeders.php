<?php

namespace Database\Seeders\Localisation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shared\Localisation\State;

class StateTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stateDatas = [
            // Austria
            ['id' => 1, 'state' => 'Burgenland', 'country_id' => 3],
            ['id' => 2, 'state' => 'Karyntia', 'country_id' => 3],
            ['id' => 3, 'state' => 'Dolna Austria', 'country_id' => 3],
            ['id' => 4, 'state' => 'Górna Austria', 'country_id' => 3],
            ['id' => 5, 'state' => 'Salzburg', 'country_id' => 3],
            ['id' => 6, 'state' => 'Styria', 'country_id' => 3],
            ['id' => 7, 'state' => 'Tyrol', 'country_id' => 3],
            ['id' => 8, 'state' => 'Vorarlberg', 'country_id' => 3],
            ['id' => 9, 'state' => 'Wiedeń', 'country_id' => 3],

            // Dania
            ['id' => 10, 'state' => 'Dania Południowa', 'country_id' => 11],
            ['id' => 11, 'state' => 'Jutlandia Północna', 'country_id' => 11],
            ['id' => 12, 'state' => 'Jutlandia Środkowa', 'country_id' => 11],
            ['id' => 13, 'state' => 'Region Stołeczny', 'country_id' => 11],
            ['id' => 14, 'state' => 'Zelandia', 'country_id' => 11],

            // Niemcy
            ['id' => 15, 'state' => 'Badenia-Wirtembergia', 'country_id' => 29],
            ['id' => 16, 'state' => 'Bawaria', 'country_id' => 29],
            ['id' => 17, 'state' => 'Berlin', 'country_id' => 29],
            ['id' => 18, 'state' => 'Brandenburgia', 'country_id' => 29],
            ['id' => 19, 'state' => 'Brema', 'country_id' => 29],
            ['id' => 20, 'state' => 'Hamburg', 'country_id' => 29],
            ['id' => 21, 'state' => 'Hesja', 'country_id' => 29],
            ['id' => 22, 'state' => 'Meklemburgia-Pomorze Przednie', 'country_id' => 29],
            ['id' => 23, 'state' => 'Dolna Saksonia', 'country_id' => 29],
            ['id' => 24, 'state' => 'Nadrenia Północna-Westfalia', 'country_id' => 29],
            ['id' => 25, 'state' => 'Nadrenia-Palatynat', 'country_id' => 29],
            ['id' => 26, 'state' => 'Saara', 'country_id' => 29],
            ['id' => 27, 'state' => 'Saksonia', 'country_id' => 29],
            ['id' => 28, 'state' => 'Saksonia-Anhalt', 'country_id' => 29],
            ['id' => 29, 'state' => 'Szlezwik-Holsztyn', 'country_id' => 29],
            ['id' => 30, 'state' => 'Turyngia', 'country_id' => 29],

            // Polska
            ['id' => 31, 'state' => 'Dolnośląskie', 'country_id' => 31],
            ['id' => 32, 'state' => 'Kujawsko-Pomorskie', 'country_id' => 31],
            ['id' => 33, 'state' => 'Lubelskie', 'country_id' => 31],
            ['id' => 34, 'state' => 'Lubuskie', 'country_id' => 31],
            ['id' => 35, 'state' => 'Łódzkie', 'country_id' => 31],
            ['id' => 36, 'state' => 'Małopolskie', 'country_id' => 31],
            ['id' => 37, 'state' => 'Mazowieckie', 'country_id' => 31],
            ['id' => 38, 'state' => 'Opolskie', 'country_id' => 31],
            ['id' => 39, 'state' => 'Podkarpackie', 'country_id' => 31],
            ['id' => 40, 'state' => 'Podlaskie', 'country_id' => 31],
            ['id' => 41, 'state' => 'Pomorskie', 'country_id' => 31],
            ['id' => 42, 'state' => 'Śląskie', 'country_id' => 31],
            ['id' => 43, 'state' => 'Świętokrzyskie', 'country_id' => 31],
            ['id' => 44, 'state' => 'Warmińsko-Mazurskie', 'country_id' => 31],
            ['id' => 45, 'state' => 'Wielkopolskie', 'country_id' => 31],
            ['id' => 46, 'state' => 'Zachodniopomorskie', 'country_id' => 31],

            //Szwecja
            ['id' => 47, 'state' => 'Blekinge', 'country_id' => 40],
            ['id' => 48, 'state' => 'Dalarna', 'country_id' => 40],
            ['id' => 49, 'state' => 'Gotland', 'country_id' => 40],
            ['id' => 50, 'state' => 'Gävleborg', 'country_id' => 40],
            ['id' => 51, 'state' => 'Halland', 'country_id' => 40],
            ['id' => 52, 'state' => 'Jämtland', 'country_id' => 40],
            ['id' => 53, 'state' => 'Jönköping', 'country_id' => 40],
            ['id' => 54, 'state' => 'Kalmar', 'country_id' => 40],
            ['id' => 55, 'state' => 'Kronoberg', 'country_id' => 40],
            ['id' => 56, 'state' => 'Norrbotten', 'country_id' => 40],
            ['id' => 57, 'state' => 'Skania', 'country_id' => 40],
            ['id' => 58, 'state' => 'Stockholm', 'country_id' => 40],
            ['id' => 59, 'state' => 'Södermanland', 'country_id' => 40],
            ['id' => 60, 'state' => 'Uppsala', 'country_id' => 40],
            ['id' => 61, 'state' => 'Värmland', 'country_id' => 40],
            ['id' => 62, 'state' => 'Västerbotten', 'country_id' => 40],
            ['id' => 63, 'state' => 'Västernorrland', 'country_id' => 40],
            ['id' => 64, 'state' => 'Västmanland', 'country_id' => 40],
            ['id' => 65, 'state' => 'Västra Götaland', 'country_id' => 40],
            ['id' => 66, 'state' => 'Örebro', 'country_id' => 40],

            // Wielka Brytania
            ['id' => 67, 'state' => 'South East England', 'country_id' => 45],
            ['id' => 68, 'state' => 'South West England', 'country_id' => 45],
            ['id' => 69, 'state' => 'East of England', 'country_id' => 45],
            ['id' => 70, 'state' => 'London', 'country_id' => 45],
            ['id' => 71, 'state' => 'East Midlands', 'country_id' => 45],
            ['id' => 72, 'state' => 'West Midlands', 'country_id' => 45],
            ['id' => 73, 'state' => 'Yorkshire and the Humber', 'country_id' => 45],
            ['id' => 74, 'state' => 'North East England', 'country_id' => 45],
            ['id' => 75, 'state' => 'North West England', 'country_id' => 45],
        ];

        foreach ($stateDatas as $stateData) {
            State::create([
                'id' => $stateData['id'],
                'state' => $stateData['state'],
                'country_id' => $stateData['country_id'],
            ]);
        }
    }
}
