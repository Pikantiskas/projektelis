<?php

namespace App\Repositories;

use App\Models\User;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    public function findExpiringPostsForUser(User $user): Collection
    {
        return $user->posts()
            ->where('status', 'active')
            ->where(
                DB::raw("DATE_FORMAT(posts.expires_at, '%Y-%m-%d')"),
                (new DateTime())->modify('+ 1day')->format('Y-m-d')
            )
            ->take(3)
            ->get();
    }

    public function findNewPostsByCategoriesForUser(User $user): Collection
    {
        return $user->posts()
            ->where('status', 'active')
            ->where(
                DB::raw("DATE_FORMAT(posts.expires_at, '%Y-%m-%d')"),
                (new DateTime())->modify('+ 1day')->format('Y-m-d')
            )
            ->take(3)
            ->get();
    }
}
