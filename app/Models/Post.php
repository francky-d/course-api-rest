<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'content',
        'slug',
        'views_count',
        'user_id',
        'category_id',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes for the post.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the favorites for the post.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Get the series that the post belongs to.
     */
    public function series()
    {
        return $this->belongsToMany(Series::class, 'post_series')
            ->withTimestamps();
    }
}
