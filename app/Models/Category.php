<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'is_active',
        'is_root',
        'parent_id'
    ];

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }
}
