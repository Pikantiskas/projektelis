<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Service\CategoryManager;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function index(): Collection
    {
        return Category::all();
    }

    public function store(Request $request): Category
    {
        $this->authorize('store', Category::class);


        return $this->categoryManager->create($request);
    }

    public function show(Category $category): Category
    {
        return $category;
    }

    public function update(Request $request, Category $category): Category
    {
        $this->authorize('update', $category);

        $category->update($request->only(['name', 'is_active', 'parent_id']));

        return $category;
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('destroy', $category);

        $category->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
