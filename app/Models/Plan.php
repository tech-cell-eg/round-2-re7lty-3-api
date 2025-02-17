<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'price',
        'plan_type',
        'target_type',
        'description',
        'options'
    ];
    protected $casts = [
        'options' => 'array',
    ];
}
