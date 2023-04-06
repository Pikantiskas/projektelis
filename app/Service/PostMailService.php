<?php

namespace App\Service;

use App\Mail\NewPostsByCategories;
use App\Mail\PostAboutToExpire;
use App\Mail\PostCreated;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class PostMailService
{
    public function informUserPostCreated(Post $post): void
    {
        Mail::to($post->user)->send(new PostCreated($post));
    }

    public function informUserPostsAboutToExpire(User $user, Collection $posts): void
    {
        Mail::to($user)->send(new PostAboutToExpire($user, $posts));
    }

    public function informUserAboutNewPostsByCategories(User $user, Collection $posts): void
    {
        Mail::to($user)->send(new NewPostsByCategories($user, $posts));
    }
}
