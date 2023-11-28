<?php

namespace App\Models\Admin\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'blog_category';

    protected $fillable = [
        'name',
        'slug',
        'description',
        // 'seo_title',
        // 'seo_description',
 
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];



    // Relation avec les articles
     public function posts()
    {
        return $this->hasMany(Post::class, 'blog_category_id', 'id');
    }
}
