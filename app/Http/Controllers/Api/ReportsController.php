<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * TODO: refactor
     *
     * @return array
     */
    public function mostStarredByCategory()
    {
        $query = DB::table('posts')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('posts_stars', 'posts_stars.post_id', '=', 'posts.id')
            ->groupBy('categories.name', 'posts.title', )
            ->where('categories.is_active', '=', true)
            ->where('posts.status', '=', 'active')
            ->select('categories.name', 'posts.title', DB::raw('count(posts_stars.id) as count'));

        $results = $query->get();

        $result = [];
        foreach ($results as $data) {
            $categoryName = $data->name;

            // jeigu categorijos name nera rezultatu array, pridekime ji ten
            if (!isset($result[$categoryName])) {
                $result[$categoryName] = ['starsCount' => 0, 'postTitles' => []];
            }

            // if post stars count equals to existing stars count, add this post title
            if ($result[$categoryName]['starsCount'] === $data->count) {
                $result[$categoryName]['postTitles'][] = $data->title;
            }

            // if post stars is more than existing stars count, reset existing titles, and set new count
            if ($data->count > $result[$categoryName]['starsCount']) {
                $result[$categoryName] = ['starsCount' => $data->count, 'postTitles' => [$data->title]];
            }
        }

        return $result;
    }
}
