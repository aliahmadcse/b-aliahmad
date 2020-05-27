<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = ['category'];

    /**
     * defines relationship with the project model
     *
     * @return One to Many relationship
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
