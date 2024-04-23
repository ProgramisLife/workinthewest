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
        $skills = collect([
    '.NET',
    'AI',
    'AJAX',
    'Android',
    'Angular',
    'Apache',
    'ASP.NET',
    'Back End Developer',
    'C',
    'C++',
    'C#',
    'CSS',
    'CSS',
    'DYSPOZYCYJNOŚĆ',
    'Excel',
    'Front End Developer',
    'Git',
    'Google Ads Words',
    'Google SEO',
    'HTML',
    'Illustrator',
    'iOS',
    'Java',
    'JavaScript',
    'Joomla',
    'jQuery',
    'JS',
    'KOMUNIKACJA SPOŁECZNA',
    'KURS BHP',
    'LAMP',
    'Linux',
    'Marketing lub pokrewne',
    'Microsoft Office',
    'MVC',
    'MySQL',
    'Negocjacje',
    'NodeJS',
    'Objective-C',
    'OOP',
    'OOP PHP',
    'Photoshop',
    'PHP',
    'Praca w zespole',
    'Public Relations',
    'PUNKTUALNOŚĆ',
    'Python',
    'Rozmowy rekrutacyjne',
    'Social Media',
    'Software Development',
    'SQL',
    'Swobodne nawiązywanie kontakty biznesowe',
    'Tworzenie baz danych kandydatów',
    'UCZCIWOŚĆ',
    'UPRAWIENIA NA WÓZEK WIDŁOWY',
    'Web Developer',
    'Word',
    'Wordpress',
]);

        $skills->each(function ($skills) {
            Skill::firstOrCreate(['skill' => $skills]);
        });
    }
}
