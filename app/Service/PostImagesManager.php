<?php


namespace App\Service;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostImagesManager
{
    public function appendPost(Post $post, array $images)
    {
        Validator::make(['images' => $images], [
            'images.*' => 'mimes:jpg,jpeg,png|max:400',
            'images' => 'max:5',
        ], [
            'images.max' => 'Cannot upload more than 5 files',
        ])->validate();

        foreach ($images as $image) {
            $path = $image->storePublicly('images', 'public');
            $post->images()->create([
                'file_path' => $path
            ]);
        }
    }
}
