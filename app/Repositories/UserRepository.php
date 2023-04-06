<?php

namespace App\Repositories;

use App\Models\User;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function findUsersWithExpiringPosts(): Collection
    {
        $users = DB::table('users')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where(
                DB::raw("DATE_FORMAT(posts.expires_at, '%Y-%m-%d')"),
                (new DateTime())->modify('+ 1day')->format('Y-m-d')
            )
            ->where('posts.status', 'active')
            ->distinct()
            ->get('users.*');

        return User::hydrate($users->all());
    }
}
