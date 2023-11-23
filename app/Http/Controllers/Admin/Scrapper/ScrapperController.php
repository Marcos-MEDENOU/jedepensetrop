<?php

namespace App\Http\Controllers\Admin\Scrapper;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ScrapperController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:scrapping list', ['only' => ['index', 'show']]);
        $this->middleware('can:scrapping create', ['only' => ['create', 'store']]);
        $this->middleware('can:scrapping edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:scrapping delete', ['only' => ['destroy']]);
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



        $posts = $posts->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Scrapping/Index', [
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
        $visibility = ['non', 'oui'];
        $categorie = Category::all()
            ->pluck('name', 'id');

        return Inertia::render('Admin/Scrapping/Create', [
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }



    public function edit(Request $request, Post $post)
    {

        $visibility = ['non', 'oui'];
        $categorie = Category::all()->pluck('name', 'id');
        return Inertia::render('Admin/Scrapping/Edit', [
            'posts' => $post,
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }

    public function show(Post $post)
    {

        return Inertia::render('Admin/Scrapping/Show', [
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

        Post::create([
            'blog_category_id' => $request->category,
            'blog_author_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'image' => $request->image,
            'post_visible' => $request->is_visible,
        ]);

        return redirect()->route('posts.index')
            ->with('message', 'post créer avec succes.');
    }

    public function update(Request $request, Post $post)
    {

        // if(is_int((int)($request->is_visible))){
        //     $request->is_visible = $request->is_visible;
        // }elseif($request->is_visible = "oui"){
        //     dd($request->is_visible);
        //     $request->is_visible=true;
        // }else{
        //     $request->is_visible=false;
        // }

        // if(is_int((int)($request->category))){
        //     $request->category = $request->category;

        // }else{

        //     $request->category= Category::where('name', $request->category)->value('id');
        // }

        $post->update([
            // 'blog_category_id' =>  $request->category,
            'blog_category_id' => $request->category,
            'blog_author_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'image' => $request->image,
            'post_visible' => $request->is_visible,
        ]);

        return redirect()->route('posts.index')
            ->with('message', 'post créer avec succes.');
    }


    // Fonction permettant d'afficher les posts par leur slug
    public function showArticle($slug)
    {
        $selectedPost = Post::where('slug', $slug)->firstOrFail();
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

        return Inertia::render('Post', [
            'post' => [
                'id' => $selectedPost->id,
                'title' => $selectedPost->title,
                'slug' => $selectedPost->slug,
                'content' => $selectedPost->content,
                'author' => User::find($selectedPost->blog_author_id),
                'category' => Category::find($selectedPost->blog_category_id),
                'image' => $selectedPost->image,
                'duree' => $estimatedReadingTime,
                'published_at' => Carbon::parse($selectedPost->published_at)->format('d/m/Y'),
                'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
                'likes_count' => $likesCount,
                'dislikes_count' => $dislikesCount,
                'user_liked' => $userLiked,
            ],
        ]);
    }


    // Fonction permettant de récupérer le dernier post publié du blog
    public function getLatestPost()
    {
        $today = now();

        $user = auth()->user(); // Récupérez l'utilisateur connecté

        $latestPost = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->latest()
            ->first();

        // Calculer la durée de lecture estimée
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
            'duree' => $estimatedReadingTime,
            'published_at' => Carbon::parse($latestPost->published_at)->format('d/m/Y'),
            'created_at' => Carbon::parse($latestPost->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($latestPost->updated_at)->format('d/m/Y'),
        ];

        return response()->json($response);
    }

    /// Fonction permettant de récupérer les 3 articles les plus récents, sauf le dernier
    public function getPreviousThreePosts()
    {
        $today = now();

        // Récupérer les quatre derniers articles publiés
        $recentPosts = Post::where('post_visible', 1)
            ->where('published_at', '<=', $today)
            ->latest()
            ->take(4)
            ->get();

        // Exclure le dernier article publié
        $previousThreePosts = $recentPosts->slice(0, 3);

        $response = $previousThreePosts->map(function ($post) {

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
                'duree' => $estimatedReadingTime,
                'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'), // Format français
                'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'), // Format français
                'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'), // Format français

            ];
        });

        return response()->json($response);
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
                    ->where('published_at', '<=', $today)->latest()->take(3)->get();

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

            return response()->json($postsByCategory);
        } catch (\Exception $th) {
            // Gérez les erreurs
            return response()->json($th);
        }
    }

    public function getCategoryWithPosts($slug)
    {
        try {
            // Récupérez la catégorie avec les articles associés
            $category = Category::where('slug', $slug)->first();
            $today = now();
            if ($category) {
                $posts = Post::where('blog_category_id', $category->id)->where('post_visible', 1)
                    ->where('published_at', '<=', $today)->get();


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
                            'duree' => $estimatedReadingTime,
                            'published' => Carbon::parse($post->published)->format('d/m/Y'),
                            'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                            'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),
                        ];
                    }),
                ];

                return Inertia::render('CategoryPosts', [
                    'formattedCategory' => $formattedCategory,
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


