<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Job;
use App\Models\Shared\JobCategory;
use App\Models\Shared\JobLevel;
use App\Models\Shared\Currency;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $title = $this->faker->sentence($this->faker->numberBetween(1, 3), true);
        $email = $this->faker->unique()->safeEmail;
        $description = $this->faker->sentence($this->faker->numberBetween(8, 16));
        $salaryfrom = $this->faker->numberBetween(2000, 5000);
        $salaryto = $this->faker->numberBetween(5001, 10000);
        $sex = $this->faker->randomElement(['Mężczyzna', 'Kobieta', 'Inne']);
        $featured = $this->faker->boolean;
        $slug = Str::uuid()->toString();
        $expiry = $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d');
        $deadline = $this->faker->dateTimeBetween('now', '+60 days')->format('d-m-Y');
        $ownerId = User::pluck('id')->random();

        $jobCategoryId = JobCategory::pluck('id')->random();
        $jobLevelId = JobLevel::pluck('id')->random();
        $jobCurrency = Currency::pluck('id')->random();

        return [
            'title' => $title,
            'email' => $email,
            'description' => $description,
            'salary_from' => $salaryfrom,
            'salary_to' => $salaryto,
            'sex' => $sex,
            'featured' => $featured,
            'slug' => $slug,
            'expiry' => $expiry,
            'deadline' => $deadline,
            'owner_id' => $ownerId,
            'jobcategory_id' => $jobCategoryId,
            'joblevel_id' => $jobLevelId,
            'currencies_id' => $jobCurrency,
        ];
    }
}
