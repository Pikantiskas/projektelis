<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\UserNotification;
use App\Policies\NotificationApiPolicy;
use App\Policies\PostPolicy;
use App\Policies\CategoryApiPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryApiPolicy::class,
        Post::class => PostPolicy::class,
        UserNotification::class => NotificationApiPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
