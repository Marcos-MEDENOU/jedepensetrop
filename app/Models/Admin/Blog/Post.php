<?php

namespace App\Models\Admin\Blog;

use App\Models\LikeDislike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    // use HasTags;

    /**
     * @var string
     */
    protected $table = 'blog_post';

    // protected $attributes = [
    //     'user_liked' => false,
    //     'user_disliked' => false,
    // ];

    protected $fillable = [
        'blog_category_id',
        'blog_author_id',
        'title',
        'slug',
        'content',
        'views_count',
        'published_at',
        'seo_title',
        'seo_description',
        'image',
        'folder',
        'post_visible',
        'category',
    ];
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'blog_author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }

    public function likesDislikes()
    {
        return $this->hasMany(LikeDislike::class);
    }

    public function userLiked($userId)
    {
        return $this->likesDislikes()
            ->where('user_id', $userId)
            ->where('is_like', true)
            ->exists();
    }

    public function userDisliked($userId)
    {
        return $this->likesDislikes()
            ->where('user_id', $userId)
            ->where('is_like', false)
            ->exists();
    }

    public function likesCount()
    {
        return $this->likesDislikes()->where('is_like', true)->count();
    }

    public function dislikesCount()
    {
        return $this->likesDislikes()->where('is_like', false)->count();
    }
}
