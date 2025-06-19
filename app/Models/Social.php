<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'href',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
