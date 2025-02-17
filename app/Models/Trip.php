<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'location',
        'price',
        'duration_days',
        'image'
    ];
}
