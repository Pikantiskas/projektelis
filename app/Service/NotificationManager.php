<?php

namespace App\Service;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\Authenticatable;

class NotificationManager
{
    /**
     * @param User $user
     * @param array $data
     *
     * @return Post
     * @throws ValidationException
     */
    public function create(Authenticatable $user, array $data)
    {
        Validator::make($data, [
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id'
        ])->validate();

        return $user->notifications()->sync($data['category_id']);
    }

}
