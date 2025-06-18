<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'contents' => 'array',
    ];
    
    
    protected $fillable = ['title', 'job', 'start_date', 'end_date', 'contents'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
