<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence($this->faker->numberBetween(1, 3), true);
        $description = $this->faker->sentence($this->faker->numberBetween(8, 16));
        $slug = Str::uuid()->toString();
        $youtube = $this->faker->url('http');
        $facebook = $this->faker->url('http');
        $vimeo = $this->faker->url('http');
        $x = $this->faker->url('http');
        $linkedin = $this->faker->url('http');
        $ownerId = User::pluck('id')->random();

        return [
            'title' => $title,
            'description' => $description,
            'slug' => $slug,
            'youtube' => $youtube,
            'facebook' => $facebook,
            'vimeo' => $vimeo,
            'x' => $x,
            'linkedin' => $linkedin,
            'owner_id' => $ownerId,
        ];
    }
}
