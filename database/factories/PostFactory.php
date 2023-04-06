<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'category_id' => 1,
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => 10.8,
            'status' => $this->faker->randomElement(['active', 'inactive', 'closed']),
            'label' => $this->faker->randomElement(['new', 'top']),
            'expires_at' => $this->faker->dateTimeBetween(now(), now()->addDays(60)),
            'show_phone_number' => $this->faker->boolean,
        ];
    }
}
