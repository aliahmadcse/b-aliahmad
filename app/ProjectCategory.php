<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model
{
    use SoftDeletes;

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
