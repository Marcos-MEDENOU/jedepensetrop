<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_post', function (Blueprint $table) {

            $table->id();
            $table->foreignId('blog_author_id')->nullable()->cascadeOnDelete();
            $table->foreignId('blog_category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->timestamp('published_at')->nullable();
            $table->string('seo_title', 160)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->string('image')->nullable();
            $table->string('folder')->nullable();
            $table->boolean('post_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post');
    }
};
