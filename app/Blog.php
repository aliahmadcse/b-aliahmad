<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [];

    /**
     * Defines an inverse relation of hasMany with Blog tags
     *
     * @return Relationship inverse of hasMany
     */
    public function tag()
    {
        return $this->belongsTo('App/BlogTag');
    }
}
