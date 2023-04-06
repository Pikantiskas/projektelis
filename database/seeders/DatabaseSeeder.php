<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostStar;
use App\Models\UserNotification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create();
        User::factory(15)->create();
        Post::factory(50)->create();
//        PostStar::factory(100)->create();
        UserNotification::factory(20)->create();
    }
}
