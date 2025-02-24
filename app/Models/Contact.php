<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'admin_reply', 'is_replied'];

    protected $casts = [
        'is_replied' => 'boolean', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeUnreplied($query)
    {
        return $query->where('is_replied', false);
    }

    public function markAsReplied($reply)
    {
        $this->update([
            'admin_reply' => $reply,
            'is_replied' => true,
        ]);
    }
}
