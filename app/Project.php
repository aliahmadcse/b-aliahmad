<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_category_id',
        'title',
        'description',
        'image',
        'display_order',
        'github',
        'live'
    ];


    /**
     * Defines an inverse relation of One To Many
     *
     * @return relationship
     */
    public function category()
    {
        return $this->belongsTo('App\ProjectCategory', 'project_category_id', 'id');
    }
}
