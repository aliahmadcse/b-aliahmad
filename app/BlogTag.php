<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = [
        'tag'
    ];

    /**
     * Defines BlogTag relationship with blogPosts
     *
     * @return Relationship one-to-may
     */
    public function posts()
    {
        return $this->hasMany('App\Blog', 'blog_tag_id', 'id');
    }
}
