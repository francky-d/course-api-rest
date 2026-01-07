<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'user_id',
    ];

    /**
     * Get the user that owns the series.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the posts that belong to the series.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_series')
            ->withTimestamps();
    }
}
