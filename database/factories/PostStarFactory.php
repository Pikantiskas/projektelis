<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\PostStar;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostStarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostStar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'post_id' => Post::inRandomOrder()->value('id'),
        ];
    }
}
