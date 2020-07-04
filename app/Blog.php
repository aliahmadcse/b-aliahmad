<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_tag_id',
        'author_id',
        'title',
        'description',
        'body',
        'image',
        'is_published'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'body' => 'array',
    ];

    /**
     * Defines an inverse of one to many relationship with BlogTag model
     *
     * @return Relationship inverse of One to Many
     */
    public function tag()
    {
        return $this->belongsTo('App\BlogTag', 'blog_tag_id', 'id');
    }

    /**
     * Defines an inverse of one to many relationship with User model
     *
     * @return Relationship inverse of One to Many
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
