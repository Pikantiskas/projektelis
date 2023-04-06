<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Service\PostMailService;

class ProcessPostNotifications
{
    private $postMailService;

    public function __construct(PostMailService $postMailService)
    {
        $this->postMailService = $postMailService;
    }

    public function handle(PostCreated $postCreated)
    {
        $this->postMailService->informUserPostCreated($postCreated->post);
    }
}
