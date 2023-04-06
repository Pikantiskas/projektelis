<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PostAboutToExpire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Collection
     */
    private $posts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $posts)
    {
        //
        $this->user = $user;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.post.about_to_expire')->with([
            'user' =>$this->user,
            'posts' => $this->posts,
        ]);
    }
}
