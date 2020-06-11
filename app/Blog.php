<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_tag_id',
        'title',
        'description',
        'body',
        'is_published'
    ];

    /**
     * Defines an inverse relation of hasMany with Blog tags
     *
     * @return Relationship inverse of hasMany
     */
    public function tag()
    {
        return $this->belongsTo('App\BlogTag', 'blog_tag_id', 'id');
    }
}
