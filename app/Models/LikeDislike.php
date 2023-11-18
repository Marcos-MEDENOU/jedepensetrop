<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    protected $table = 'likes_dislikes';

    protected $fillable = [
        'post_id',
        'user_id',
        'is_like',
    ];

    // ... autres propriétés et méthodes

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
