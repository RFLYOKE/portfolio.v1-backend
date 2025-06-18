<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $casts = [
        'contents' => 'array',
    ];
    
    protected $fillable = ['title', 'job', 'date', 'contents'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
