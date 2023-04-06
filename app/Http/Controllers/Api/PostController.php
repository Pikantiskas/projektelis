<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Service\PostManager;
use Illuminate\Http\Response;
use App\Service\CurrencyConversionService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class PostController extends Controller
{
    private $postManager;
    private $currencyService;

    public function __construct(
        PostManager $postManager,
        CurrencyConversionService $currencyService
    ) {
        // basic auth yra username + password
        $this->middleware('auth.basic', ['except' => [
            'index',
            'show',
        ]]);

        $this->postManager = $postManager;
        $this->currencyService = $currencyService;
    }

    public function index(): Collection
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $this->setUsdPriceOnPost($post);
        }

        return $posts;
    }

    public function store(Request $request): Post
    {
        $post = $this->postManager->create(
            $request->user(),
            $request->only('title', 'description', 'price', 'category_id', 'expires_at', 'show_phone_number')
        );

        return $this->setUsdPriceOnPost($post);
    }

    public function show(Post $post): Post
    {
        return $this->setUsdPriceOnPost($post);
    }

    public function update(Request $request, Post $post): Post
    {
        $this->authorize('update', $post);

        $post->update(
            $request
                ->only('title', 'description', 'price', 'category_id', 'expires_at', 'show_phone_number')
        );

        return $this->setUsdPriceOnPost($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    private function setUsdPriceOnPost(Post $post): Post
    {
        return $post->setAttribute('priceUsd', $this->currencyService->convertPriceToUsd($post->price));
    }
}
