<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    protected static function booted(): void
    {
        static::created(function ($tag) {
            $user = User::find(1);
            if ($user) {
                $user->tags()->attach($tag->id);
            }
        });
    }
}
