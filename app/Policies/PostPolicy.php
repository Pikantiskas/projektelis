<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Post $post): bool
    {
        return $this->isAdminOrOwner($user, $post);
    }

    public function update(User $user, Post $post): bool
    {
        return $this->isAdminOrOwner($user, $post);
    }

    public function star(User $user, Post $post): bool
    {
        return $post->user_id !== $user->id && $post->starredBy($user) === false;
    }

    public function unstar(User $user, Post $post): bool
    {
        return $post->user_id !== $user->id && $post->starredBy($user) === true;
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    private function isAdminOrOwner(User $user, Post $post): bool
    {
        return $user->is_admin === true || $user->id === $post->user_id;
    }
}
