<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryApiPolicy
{
    use HandlesAuthorization;

    public function store(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user)
    {
        return $user->is_admin;
    }

    public function destroy(User $user)
    {
        return $user->is_admin;
    }
}
