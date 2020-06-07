<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = [];

    /**
     * Defines BlogTag relationship with blogPosts
     *
     * @return Relationship one-to-may
     */
    public function posts()
    {
        return $this->hasMany('App\Blog');
    }
}
