<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference_code' => $this->faker->unique()->numerify('#########'),
            'title' => $this->faker->unique()->words(2),
            'category' => $this->faker->randomElement(['action','drama','comedy','documentary']),
            'image' => $this->faker->imageUrl(),
            'year_of_making' => $this->faker->year('now'),
        ];
    }
}
