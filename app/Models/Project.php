<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $casts = [
        'sub_description' => 'array',
    ];
    
    protected $fillable = ['user_id', 'title', 'description', 'href', 'logo', 'image'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }
    
}
