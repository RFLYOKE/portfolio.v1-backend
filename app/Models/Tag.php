<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'path'];
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tag');
    }
}
