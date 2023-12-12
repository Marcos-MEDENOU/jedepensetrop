<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        try {

            $categories = Category::whereHas('posts')
                ->get();
            $searchTerm = $request->input('query');

            $results = Post::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('category', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->distinct()
            ->paginate(10);;

            $response = $results->map(function ($post) {
                if ($post) {

                    // Calculer la durée de lecture estimée
                    $wordCount = str_word_count(strip_tags($post->content)); // Compter les mots dans le contenu
                    $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

                    $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'content' => $post->content,
                        'author' => User::find($post->blog_author_id), // Utilisez $post au lieu de $recentPosts
                        'category' => Category::find($post->blog_category_id), // Utilisez $post au lieu de $recentPosts
                        'image' => $post->image,
                        'folder' => $post->folder,
                        'duree' => $estimatedReadingTime,
                        'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'), // Format français
                        'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'), // Format français
                        'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'), // Format français

                    ];
                }
            });


            return Inertia::render('SearchResults', [
                'searchTerm' => $response,
                'categories' => $categories
            ]);

        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
