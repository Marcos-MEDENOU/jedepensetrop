<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\LikeDislike;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeDislikeController extends Controller
{
    public function like($postId)
    {
        try {
            $user = auth()->user();

            // Vérifier si l'utilisateur a déjà aimé le post
        $existingLike = LikeDislike::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingLike) {
            // Si l'utilisateur a déjà aimé, mettre à jour le like existant
            $existingLike->update(['is_like' => true]);
        } else {
            // Sinon, créer un nouveau like
            LikeDislike::create([
                'post_id' => $postId,
                'user_id' => $user->id,
                'is_like' => true,
            ]);
        }

            $selectedPost = Post::where('id', $postId)->firstOrFail();
            $user = auth()->user(); // Récupérez l'utilisateur connecté

            // Calculer la durée de lecture estimée
            $wordCount = str_word_count(strip_tags($selectedPost->content)); // Compter les mots dans le contenu
            $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute
            $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

            // Obtenir le nombre total de likes et dislikes pour le post
            $likesCount = $selectedPost->likesDislikes()->where('is_like', true)->count();
            $dislikesCount = $selectedPost->likesDislikes()->where('is_like', false)->count();

            // Vérifier si l'utilisateur connecté a déjà aimé le post
            $userLiked = $user ? $selectedPost->userLiked($user->id) : false;

            return response()->json([
                'post' => [
                    'id' => $selectedPost->id,
                    'title' => $selectedPost->title,
                    'slug' => $selectedPost->slug,
                    'content' => $selectedPost->content,
                    'author' => UserController::find($selectedPost->blog_author_id),
                    'category' => Category::find($selectedPost->blog_category_id),
                    'image' => $selectedPost->image,
                    'duree' => $estimatedReadingTime,
                    'published_at' => Carbon::parse($selectedPost->published_at)->format('d/m/Y'),
                    'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                    'user_liked' => $userLiked,
                ]
            ])
            ;


        } catch (\Exception $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function dislike($postId)
    {
        try {
            $user = auth()->user();

            // Vérifier si l'utilisateur a déjà aimé le post
        $existingLike = LikeDislike::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingLike) {
            // Si l'utilisateur a déjà aimé, mettre à jour le like existant
            $existingLike->update(['is_like' => false]);
        } else {
            // Sinon, créer un nouveau like
            LikeDislike::create([
                'post_id' => $postId,
                'user_id' => $user->id,
                'is_like' => false,
            ]);
        }

            $selectedPost = Post::where('id', $postId)->firstOrFail();
            $user = auth()->user(); // Récupérez l'utilisateur connecté

            // Calculer la durée de lecture estimée
            $wordCount = str_word_count(strip_tags($selectedPost->content)); // Compter les mots dans le contenu
            $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute
            $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

            // Obtenir le nombre total de likes et dislikes pour le post
            $likesCount = $selectedPost->likesDislikes()->where('is_like', true)->count();
            $dislikesCount = $selectedPost->likesDislikes()->where('is_like', false)->count();

            // Vérifier si l'utilisateur connecté a déjà aimé le post
            $userLiked = $user ? $selectedPost->userLiked($user->id) : false;

            return response()->json([
                'post' => [
                    'id' => $selectedPost->id,
                    'title' => $selectedPost->title,
                    'slug' => $selectedPost->slug,
                    'content' => $selectedPost->content,
                    'author' => UserController::find($selectedPost->blog_author_id),
                    'category' => Category::find($selectedPost->blog_category_id),
                    'image' => $selectedPost->image,
                    'duree' => $estimatedReadingTime,
                    'published_at' => Carbon::parse($selectedPost->published_at)->format('d/m/Y'),
                    'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                    'user_liked' => $userLiked,
                ]
            ])
            ;
        } catch (\Exception $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
