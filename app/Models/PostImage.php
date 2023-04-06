<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected  $table = 'posts_images';

    use HasFactory;

    protected $fillable = [
        'file_path'
    ];
}
