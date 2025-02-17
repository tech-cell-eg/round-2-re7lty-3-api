<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'content',
        'rating',
        'image',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
