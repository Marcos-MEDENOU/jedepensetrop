<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:category list', ['only' => ['index', 'show']]);
        $this->middleware('can:category create', ['only' => ['create', 'store']]);
        $this->middleware('can:category edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:category delete', ['only' => ['destroy']]);
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
        $visibility = ['non', 'oui'];
        $categorie = Category::all()
            ->pluck('name', 'id');

        return Inertia::render('Admin/Posts/Create', [
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }

    // Fonction permettant d'afficher les posts par leur slug
    public function showArticle($slug)
    {
        $selectedPost = Post::where('slug', $slug)->firstOrFail();

        // Calculer la durée de lecture estimée
        $wordCount = str_word_count(strip_tags($selectedPost->content)); // Compter les mots dans le contenu
        $wordsPerMinute = 200; // Estimation moyenne du nombre de mots lus par minute

        $estimatedReadingTime = ceil($wordCount / $wordsPerMinute); // Durée de lecture estimée en minutes

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
                'published_at' => Carbon::parse($selectedPost->published_at)->format('d/m/Y'), // Format français
                'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
            ],
        ]);
    }


    public function edit(Request $request,Post $post)
    {


        $visibility = ['non', 'oui'];
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


        Post::create([
            'blog_category_id' => Category::where('name', $request->category)->value('id'),
            'blog_author_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'image' => $request->image,
            'post_visible' => ($request->is_visible == "oui") ? true : false,
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
            'blog_category_id' => Category::where('name', $request->category)->value('id'),
            'blog_author_id'=>Auth::user()->id,
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

    // Fonction permettant de récupérer les 4 derniers posts recentes du blog
    public function getRecentPosts()
    {
        $recentPosts = Post::where('post_visible', 1)
            ->latest()
            ->take(6)
            ->get();

        $response = $recentPosts->map(function ($post) {
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

            foreach ($categories as $category) {
                $posts = Post::where('blog_category_id', $category->id)->latest()->take(3)->get();

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
                            'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'), // Format français
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

            if ($category) {
                $posts = Post::where('blog_category_id', $category->id)->get();

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
                            'published_at' => Carbon::parse($post->published_at)->format('d/m/Y'), // Format français
                            'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
                            'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'),
                        ];
                    }),
                ];

                return Inertia::render('CategoryPosts', [
                    'formattedCategory' => $formattedCategory
                ]);
            } else {
                return Inertia::render('CategoryPosts', ['error' => 'Catégorie non trouvée']);
            }
        } catch (\Exception $th) {
            // Gérez les erreurs
            return Inertia::render('CategoryPosts', ['error' => $th->getMessage()]);
        }
    }




}

