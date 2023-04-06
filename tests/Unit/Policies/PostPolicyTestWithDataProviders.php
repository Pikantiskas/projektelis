<?php

namespace Tests\Unit\Policies;

use App\Models\User;
use App\Models\Post;
use App\Policies\PostPolicy;
use PHPUnit\Framework\TestCase;

class PostPolicyTestWithDataProviders extends TestCase
{
    private $postPolicy;

    protected function setUp(): void
    {
        $this->postPolicy = new PostPolicy();
    }

    /**
     * @dataProvider dataProviderDeletePost
     */
    public function test_deletes_post(callable $createUser, callable $createPost): void
    {
        $user = $createUser();
        $post = $createPost();
        $result = $this->postPolicy->delete($user, $post);

        $this->assertSame(true, $result);
    }

    public function dataProviderDeletePost(): array
    {
        return [
            'deletes post when user is admin' => [
                function () {
                    $user = new User();
                    $user->id = 1;
                    $user->is_admin = true;

                    return $user;
                },
                function () {
                    $post = new Post();
                    $post->user_id = 2;

                    return $post;
                },
            ],
            'delete post when user is owner of the post' => [
                function () {
                    $user = new User();
                    $user->id = 1;

                    return $user;
                },
                function () {
                    $post = new Post();
                    $post->user_id = 1;

                    return $post;
                },
            ],
        ];
    }
}
