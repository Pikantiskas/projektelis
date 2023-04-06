<?php

namespace Tests\Unit\Policies;



use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class PostPolicyTest extends TestCase
{
    private PostPolicy $postPolicy;
    private User $user;
    private Post $post;

    protected  function  setUp(): void
    {
        $this->postPolicy = new PostPolicy();
        $this->user = new User();
        $this->post = new Post();
    }

    public function test_deleted_post_when_logged_in_as_admin(): void
    {
        $this->user->id = 1;
        $this->user->is_admin = true;

        $this->post->user_id = 2;

        $result = $this->postPolicy->delete($this->user, $this->post);

        $this->assertSame(true, $result);
    }

    public function test_deleted_post_when_user_is_owner(): void
    {
        $this->user->id = 1;

        $this->post->user_id = 1;

        $result = $this->postPolicy->delete($this->user, $this->post);

        $this->assertSame(true, $result);
    }
}
