<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'price',
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function stars()
    {
        return $this->hasMany(PostStar::class);
    }

    public function starredBy(User $user): bool
    {
        return $this->stars->contains('user_id', $user->id);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'users_notifications');
    }
}
