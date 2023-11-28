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
            $table->foreignId('blog_author_id')->nullable()->onDelete('cascade');
            $table->foreignId('blog_category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->timestamp('published_at')->nullable();
            $table->string('seo_title', 160)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->string('image')->nullable();
            $table->boolean('post_visible')->default(false);
            $table->timestamps();


            // $table->id();
            // $table->string('title');
            // $table->string('slug')->unique();
            // $table->enum('status',['brouillon', 'publié', 'en cours']);
            // $table->foreign('category_id')
            //     ->references('id')
            //     ->on('blog_category')
            //     ->onDelete('cascade');
            // $table->string('image')->nullable();
            // $table->dateTime('publish_datetime');
            // $table->boolean('category_visible')->default(true);
            // $table->boolean('post_visible')->default(false);
            // $table->content('content');
            // $table->string('meta_title')->nullable();
            // $table->string('meta_description');
            // $table->string('meta_postkey_seo');
            // $table->string('author')->nullable();
            // $table->timestamps();
            //Au cas ou l'auteur serait un utilisateur inscrit
            // $table->foreignId('user_id')
            //     ->constrained()
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
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
