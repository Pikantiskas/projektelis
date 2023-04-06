<?php

namespace App\Http\Controllers;

use App\Mail\Test;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public const PAGE_SIZE = 5;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get logged in user
        $user = auth()->user();

        //get user posts
        $posts = Post::where('user_id', $user['id'])->simplePaginate(17);

//        dd($posts);

        return view('dashboard.index', ['posts' => $posts]);
    }

    public function filter(Request $request)
    {
        $user = auth()->user();
        $posts = $user->posts();

        if ($request['status'] === null) {
            $request->merge(['status' => 'active']);
        }

        $this->validate($request, [
            'status' => ['required', Rule::in(['active', 'inactive', 'closed'])]
        ]);

        $posts->where('status', $request['status']);

        return view ('dashboard.index', ['posts' => $posts->paginate(self::PAGE_SIZE)]);
    }
}
