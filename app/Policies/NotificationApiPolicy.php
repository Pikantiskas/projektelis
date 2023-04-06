<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationApiPolicy
{
    use HandlesAuthorization;

    public function show(User $user, UserNotification $userNotification): bool
    {
        return $this->isAdminOrOwner($user, $userNotification);
    }

    public function delete(User $user, UserNotification $userNotification): bool
    {
        return $this->isAdminOrOwner($user, $userNotification);
    }

    /**
     * @param User $user
     * @param UserNotification $userNotification
     * @return bool
     */
    private function isAdminOrOwner(User $user, UserNotification $userNotification): bool
    {
        return $user->is_admin == true || $user->id === $userNotification->user_id;
    }
}
