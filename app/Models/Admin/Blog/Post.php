<?php

namespace App\Models\Admin\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory;
    // use HasTags;

    /**
     * @var string
     */
    protected $table = 'blog_post';

    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'content',
        'published_at',
        'seo_title',
        'seo_description',
        'image',
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

    public function category(): BelongsTo
    {
        return $this->belongsToMany(Category::class, 'article_category', 'post_id', 'category_id');
    }
}
