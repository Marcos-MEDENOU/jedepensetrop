<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\TemporaryImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:posts list', ['only' => ['index', 'show']]);
        $this->middleware('can:posts create', ['only' => ['create', 'store']]);
        $this->middleware('can:posts edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:posts delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $posts = (new Post)->newQuery()
            ->join('blog_category', 'blog_post.blog_category_id', '=', 'blog_category.id')
            ->join('users', 'blog_post.blog_author_id', '=', 'users.id')
            ->select('blog_post.*', 'blog_category.name as category_name', 'users.name as author_name');

        if (request()->has('search')) {
            $posts->where('title', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $posts->orderBy($attribute, $sort_order);
        } else {
            $posts->latest();
        }

        $posts = $posts->paginate(8)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('category create'),
                'edit' => Auth::user()->can('category edit'),
                'delete' => Auth::user()->can('category delete'),
            ],
        ]);
    }

    public function create()
    {
        $visibility = ['Mettre l\'article en brouillon', 'Autoriser la publication automatique'];
        $categorie = Category::all()
            ->pluck('name', 'id');

        return Inertia::render('Admin/Posts/Create', [
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }

    public function edit(Request $request, Post $post)
    {

        $visibility = ['Mettre l\'article en brouillon', 'Autoriser la publication automatique'];
        $categorie = Category::all()->pluck('name', 'id');
        return Inertia::render('Admin/Posts/Edit', [
            'posts' => $post,
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }

    public function show(Post $post)
    {

        return Inertia::render('Admin/Posts/Show', [
            'posts' => $post,
            // 'roles' => $roles,
            // 'userHasRoles' => $userHasRoles,
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('message', __('Post deleted successfully'));
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('images', 'public');

            return response()->json([
                'path' => $path,
            ]);
        }

        return response()->json([
            'error' => 'No image file found',
        ], 400);
    }

    public function editorUpload(Request $request, Post $post)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);
    }

    public function store(Request $request)
    {

        // dd($request);
        //Récupérer tous les elements de la table temporaryImages
        $temporaryImages = TemporaryImage::all();

        $image = "";
        foreach ($temporaryImages as $temporaryImage) {
            if ($temporaryImage->folder == $request->image) {
                $image = $temporaryImage->file;

                Storage::copy('public/images/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, 'public/images/' . $temporaryImage->folder . '/' . $temporaryImage->file);
                // Image::create([
                //     'post_id' => $post->id,
                //     'name' => $temporaryImage->file,
                //     'path' => $temporaryImage->folder . '/' . $temporaryImage->file,
                // ]);
                Storage::deleteDirectory('public/images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }

        }

        $post = Post::create([
            'blog_category_id' => $request->category,
            'blog_author_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'image' => $image,
            'folder' => $request->image,
            'post_visible' => $request->is_visible,
        ]);

        return redirect()->route('posts.index')
            ->with('message', 'post créer avec succes.');
    }

    public function update(Request $request, Post $post)
    {

        //Récupérer tous les elements de la table temporaryImages
        $temporaryImages = TemporaryImage::all();

        $folderChecker = TemporaryImage::where('folder', $request->folder)->first();

        if ($folderChecker) {
            $image = "";
            foreach ($temporaryImages as $temporaryImage) {
                if ($temporaryImage->folder == $request->folder) {
                    $image = $temporaryImage->file;

                    Storage::copy('public/images/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, '/public/images/\/' . $temporaryImage->folder . '/' . $temporaryImage->file);

                    Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                    $temporaryImage->delete();
                }

                Storage::copy('public/images/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, '/public/images/\/' . $temporaryImage->folder . '/' . $temporaryImage->file);

                Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            $post->update([
                'blog_category_id' => $request->category,
                'blog_author_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'image' => $image,
                'folder' => $request->folder,
                'post_visible' => $request->is_visible,
            ]);
            return redirect()->route('posts.index')
                ->with('message', 'post mis a jour avec succes.');
        } else {
            $post->update([
                'blog_category_id' => $request->category,
                'blog_author_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'image' => $request->image,
                'folder' => $request->folder,
                'post_visible' => $request->is_visible,
            ]);
            return redirect()->route('posts.index')
                ->with('message', 'Aucune modification apporté');
        }

    }

    // Fonction permettant de récupérer les posts les plus vue.
    // Fonction permettant de récupérer les posts les plus vus.
    public function getTopThreePosts()
    {
        $topThreePosts = Post::with('category')
            ->orderByDesc('views_count')
            ->take(3)
            ->get();

        $topViewedPost = $topThreePosts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'author' => $post->author,
                'category' => Category::find($post->blog_category_id),
                'image' => $post->image,
                'folder' => $post->folder,
                'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'),
                'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),
            ];
        });

        return $topViewedPost;
    }
    // Fonction permettant d'afficher les posts par leur slug
    public function showArticle($slug)
    {
        $categories = Category::whereHas('posts')
            ->get();


        $selectedPost = Post::where('slug', $slug)->firstOrFail();
        $user = auth()->user(); // Récupérez l'utilisateur connecté


        // Récupérer les 4 derniers articles liés à la même catégorie
        $relatedPosts = Post::where('blog_category_id', $selectedPost->blog_category_id)
            ->where('id', '!=', $selectedPost->id)
            ->latest()
            ->take(4)
            ->get();

        // Utiliser la méthode map pour itérer sur chaque article lié
        $relatedPostsData = $relatedPosts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'author' => User::find($post->blog_author_id),
                'category' => Category::find($post->blog_category_id),
                'image' => $post->image,
                'folder' => $post->folder,
                'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'),
                'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),

            ];
        });

        // dd($relatedPostsData->toArray());

        // Incrémenter le nombre de vues si l'article n'a pas encore été vu depuis cette adresse IP et ce localStorage
        $selectedPost->increment('views_count');


        // Calculer la durée de lecture estimée
        $wordCount = str_word_count(strip_tags($selectedPost->content)); // Compter les mots dans le contenu
        $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute
        $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

        // Obtenir le nombre total de likes et dislikes pour le post
        $likesCount = $selectedPost->likesDislikes()->where('is_like', true)->count();
        $dislikesCount = $selectedPost->likesDislikes()->where('is_like', false)->count();

        // Vérifier si l'utilisateur connecté a déjà aimé le post
        $userLiked = $user ? $selectedPost->userLiked($user->id) : false;

      

        return Inertia::render('Post', [
            'post' => [
                'id' => $selectedPost->id,
                'title' => $selectedPost->title,
                'slug' => $selectedPost->slug,
                'content' => $selectedPost->content,
                'author' => User::find($selectedPost->blog_author_id),
                'category' => Category::find($selectedPost->blog_category_id),
                'image' => $selectedPost->image,
                'folder' => $selectedPost->folder,
                'duree' => $estimatedReadingTime,
                'published_at' => Carbon::parse($selectedPost->published_at)->format('d/m/Y'),
                'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
                'likes_count' => $likesCount,
                'dislikes_count' => $dislikesCount,
                'user_liked' => $userLiked,
            ],
            'relatedPosts' => $relatedPostsData->toArray(),
            'TopThreePosts' => $this->getTopThreePosts()->toArray(),
            'categories' => $categories,
        ]);
    }

    // Fonction permettant de récupérer le dernier post publié du blog
    public function getLatestPost()
    {
        $today = now();

        $user = auth()->user(); // Récupérez l'utilisateur connecté

        $latestPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)

            ->orderBy('published_at', 'DESC')
            ->first();
        if ($latestPost) {
            $wordCount = str_word_count(strip_tags($latestPost->content)); // Compter les mots dans le contenu
            $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

            $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

            $response = [
                'id' => $latestPost->id,
                'title' => $latestPost->title,
                'slug' => $latestPost->slug,
                'seo_description' => $latestPost->seo_description,
                'content' => $latestPost->content,
                'author' => User::find($latestPost->blog_author_id),
                'category' => Category::find($latestPost->blog_category_id),
                'image' => $latestPost->image,
                'folder' => $latestPost->folder,
                'duree' => $estimatedReadingTime,
                'published_at' => Carbon::parse($latestPost->published_at)->format('d/m/Y'),
                'created_at' => Carbon::parse($latestPost->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($latestPost->updated_at)->format('d/m/Y'),
            ];

            return $response;
        }
        // Calculer la durée de lecture estimée
        // $wordCount = str_word_count(strip_tags($latestPost->content)); // Compter les mots dans le contenu
        // $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

        // $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes


    }

    /// Fonction permettant de récupérer les 3 articles les plus récents, sauf le dernier
    public function getPreviousThreePosts()
    {
        $today = now();

        // Récupérer les quatre derniers articles publiés
        $recentPosts = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)

            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // Exclure le dernier article publié
        $previousThreePosts = $recentPosts->slice(1)->reverse();

        $response = $previousThreePosts->map(function ($post) {
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

        return $response;
    }

    // Fonction permettant de recupérer trois articles par catégorie.

    public function showThreeByCategory()
    {
        try {
            // Récupérez toutes les catégories
            $categories = Category::all();

            // Récupérez trois articles pour chaque catégorie avec le formatage
            $postsByCategory = [];
            $today = now();

            foreach ($categories as $category) {
                $posts = Post::where('blog_category_id', $category->id)->where('post_visible', 1)
                    ->where('published_at', '<=', $today)
                    ->orderBy('published_at', 'desc')->take(3)->get();

                if ($posts->isNotEmpty()) {
                    $formattedPosts = $posts->map(function ($post) {
                        // Calculer la durée de lecture estimée
                        $wordCount = str_word_count(strip_tags($post->content)); // Compter les mots dans le contenu
                        $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

                        $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes
                        return [
                            'id' => $post->id,
                            'title' => $post->title,
                            'slug' => $post->slug,
                            'content' => $post->content,
                            'author' => User::find($post->blog_author_id),
                            'category' => Category::find($post->blog_category_id),
                            'image' => $post->image,
                            'folder' => $post->folder,
                            'duree' => $estimatedReadingTime,
                            'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'),
                            'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                            'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),
                        ];
                    });

                    $postsByCategory[] = [
                        'category' => $category->name,
                        'posts' => $formattedPosts,
                    ];
                }
            }

            return $postsByCategory;
        } catch (\Exception $th) {
            // Gérez les erreurs
            return response()->json($th);
        }
    }

    public function getCategoryWithPosts($slug)
    {
        try {
            $categories = Category::whereHas('posts')
                ->get()->toArray();
            // Récupérez la catégorie avec les articles associés
            $category = Category::where('slug', $slug)->first();
            $today = now();
            if ($category) {
                $posts = Post::where('blog_category_id', $category->id)->where('post_visible', 1)
                    ->where('published_at', '<=', $today)->orderBy('published_at', 'desc')->get();

                $formattedCategory = [
                    'category' => $category->name,
                    'posts' => $posts->map(function ($post) {
                        // Calculer la durée de lecture estimée
                        $wordCount = str_word_count(strip_tags($post->content)); // Compter les mots dans le contenu
                        $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

                        $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

                        return [
                            'id' => $post->id,
                            'title' => $post->title,
                            'slug' => $post->slug,
                            'content' => $post->content,
                            'author' => User::find($post->blog_author_id),
                            'category' => Category::find($post->blog_category_id),
                            'image' => $post->image,
                            'folder' => $post->folder,
                            'duree' => $estimatedReadingTime,
                            'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'),
                            'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                            'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),
                        ];
                    }),
                ];



                return Inertia::render('CategoryPosts', [
                    'formattedCategory' => $formattedCategory,
                    'TopThreePosts' => $this->getTopThreePosts()->toArray(),
                    'categories' => $categories,
                ]);
            } else {
                return Inertia::render('CategoryPosts', ['error' => 'Catégorie non trouvée']);
            }
        } catch (\Exception $th) {
            // Gérez les erreurs
            return Inertia::render('CategoryPosts', ['error' => $th->getMessage()]);
        }
    }

    // Fonction permettant de récupérer l'article précédent par rapport à un article donné
    public function getPreviousPost($id)
    {
        $today = now();
        $user = auth()->user(); // Récupérez l'utilisateur connecté
        $currentPost = Post::findOrFail($id);

        // Récupérer l'article précédent par date de publication
        $previousPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->where('id', '<', $currentPost->id)
            ->latest('published_at')
            ->first();

        if ($previousPost) {
            // Calculer la durée de lecture estimée
            $wordCount = str_word_count(strip_tags($previousPost->content)); // Compter les mots dans le contenu
            $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

            $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

            // Obtenir le nombre total de likes et dislikes pour le post
            $likesCount = $previousPost->likesDislikes()->where('is_like', true)->count();
            $dislikesCount = $previousPost->likesDislikes()->where('is_like', false)->count();

            // Vérifier si l'utilisateur connecté a déjà aimé le post
            $userLiked = $user ? $previousPost->userLiked($user->id) : false;
            return Inertia::render('Post', [
                'post' => [
                    'id' => $previousPost->id,
                    'title' => $previousPost->title,
                    'slug' => $previousPost->slug,
                    'content' => $previousPost->content,
                    'author' => User::find($previousPost->blog_author_id),
                    'category' => Category::find($previousPost->blog_category_id),
                    'image' => $previousPost->image,
                    'folder' => $previousPost->folder,
                    'duree' => $estimatedReadingTime,
                    'published_at' => Carbon::parse($previousPost->published_at)->format('d/m/Y'),
                    'created_at' => Carbon::parse($previousPost->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($previousPost->updated_at)->format('d/m/Y'),
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                    'user_liked' => $userLiked,
                ],
            ]);
        } else {
            return Inertia::render('Post', [
                'post' => ['errorMessage' => 'Aucun article précedent trouvé.'],
            ]);
        }
    }

    // Fonction permettant de récupérer l'article suivant par rapport à un article donné
    public function getNextPost($id)
    {
        $today = now();
        $user = auth()->user(); // Récupérez l'utilisateur connecté
        $currentPost = Post::findOrFail($id);

        // Récupérer l'article suivant par date de publication
        $nextPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->where('id', '>', $currentPost->id)
            ->oldest('published_at')
            ->first();

        if ($nextPost) {
            // Calculer la durée de lecture estimée
            $wordCount = str_word_count(strip_tags($nextPost->content)); // Compter les mots dans le contenu
            $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

            $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

            // Obtenir le nombre total de likes et dislikes pour le post
            $likesCount = $nextPost->likesDislikes()->where('is_like', true)->count();
            $dislikesCount = $nextPost->likesDislikes()->where('is_like', false)->count();

            // Vérifier si l'utilisateur connecté a déjà aimé le post
            $userLiked = $user ? $nextPost->userLiked($user->id) : false;
            return Inertia::render('Post', [
                'post' => [
                    'id' => $nextPost->id,
                    'title' => $nextPost->title,
                    'slug' => $nextPost->slug,
                    'content' => $nextPost->content,
                    'author' => User::find($nextPost->blog_author_id),
                    'category' => Category::find($nextPost->blog_category_id),
                    'image' => $nextPost->image,
                    'folder' => $nextPost->folder,
                    'duree' => $estimatedReadingTime,
                    'published_at' => Carbon::parse($nextPost->published_at)->format('d/m/Y'),
                    'created_at' => Carbon::parse($nextPost->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($nextPost->updated_at)->format('d/m/Y'),
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                    'user_liked' => $userLiked,
                ],
            ]);
        } else {
            return Inertia::render('Post', [
                'post' => ['errorMessage' => 'Aucun article suivant trouvé.'],
            ]);
        }
    }

    // Fonction pour vérifier s'il y a un article précédent
    public function hasPreviousPost($postId)
    {
        $today = now();

        $currentPost = Post::findOrFail($postId);

        $previousPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->where('id', '<', $currentPost->id)
            ->latest('published_at')
            ->first();

        return response()->json(['hasPrevious' => $previousPost !== null]);
    }

    // Fonction pour vérifier s'il y a un article suivant
    public function hasNextPost($postId)
    {
        $today = now();

        $currentPost = Post::findOrFail($postId);

        $nextPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->where('id', '>', $currentPost->id)
            ->oldest('published_at')
            ->first();

        return response()->json(['hasNext' => $nextPost !== null]);
    }
}
