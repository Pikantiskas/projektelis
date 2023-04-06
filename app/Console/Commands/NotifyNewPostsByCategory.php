<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserNotification;
use App\Service\PostMailService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class NotifyNewPostsByCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evis:notify:new_posts_by_categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends mail to users about nwq posts by categories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $postMailService = new PostMailService();
        $distinct_users = UserNotification::select('user_id')->distinct()->get();

        for ($i=0; $i<count($distinct_users); $i++) {
            $result[$i] = new Collection();
            $user = User::find($distinct_users[$i]->user_id);

            $category_ids = $user->notifications;
            foreach ($category_ids as $category_id) {
                $result[$i] = $result[$i]->mergeRecursive($category_id->posts->where('created_at', '>', Carbon::now()->subDay())->where('status', 'active'));
            }
            if (count($result[$i]) > 0) {
                $postMailService->informUserAboutNewPostsByCategories($user, $result[$i]);
            }
        }

        return 0;
    }
}
