<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostsStarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post): RedirectResponse
    {
        $this->authorize('star', $post);

        $post->stars()->create([
            'user_id' => auth()->user()->id
        ]);

        return back();
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('unstar', $post);

        $post->stars()->where('user_id', auth()->user()->id)->delete();

        return back();
    }
}
