<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    ];

    /**
     * Get the posts for the category.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
