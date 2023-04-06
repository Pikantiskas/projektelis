<?php

namespace App\Console\Commands;

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Service\PostMailService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyExpiringPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evis:notify:expiring_posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends mail to users about expiring posts';
    /**
     * @var PostMailService
     */
    private $postMailService;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostMailService $postMailService, PostRepository $postRepository, UserRepository $userRepository)
    {
        parent::__construct();
        $this->postMailService = $postMailService;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $log = [];

        foreach ($this->userRepository->findUsersWithExpiringPosts() as $user) {
            $expiringPosts = $this->postRepository->findExpiringPostsForUser($user);
            $this->postMailService->informUserPostsAboutToExpire($user, $expiringPosts);
            $log[(int) $user->id] = $expiringPosts->pluck('id')->toArray();
        }

        Log::info('Post expiration emails send to users:', $log);
        return 0;
    }
}
