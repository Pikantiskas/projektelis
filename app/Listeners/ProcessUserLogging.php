<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;

class ProcessUserLogging
{
    public function handle(UserRegistered $userRegistered)
    {
        $user = $userRegistered->user;

        Log::info('New user has registered:', ['id' => $user->id]);
    }
}
