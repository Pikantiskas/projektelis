<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy()
    {
        // create user
        $user = User::factory()->create();
        $user->is_admin = true;
        $user->update();

        $this->be($user);
        // creat category
        Category::factory()->create();

        // make request to delete endpoint
        $response = $this->deleteJson('/api/category/1');

        // assert category was deleted
        $this->assertDatabaseMissing('categories', ['id' => 1]);
        $response->assertStatus(204);
    }
}
