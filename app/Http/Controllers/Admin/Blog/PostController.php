<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use Exception;
use FFI;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use League\Flysystem\Visibility;

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
        $posts = (new Post)->newQuery();
        ;

        if (request()->has('search')) {
            $posts->where('name', 'Like', '%' . request()->input('search') . '%');
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
            ]
        ]);
    }

    // Fonction permettant de récupérer les 4 derniers posts recentes du blog
    public function getRecentPosts()
    {
        $recentPosts = Post::where('post_visible', 1)
            ->latest()
            ->take(4)
            ->get();

        $response = $recentPosts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'author' => User::find($post->blog_author_id), // Utilisez $post au lieu de $recentPosts
                'category' => Category::find($post->blog_category_id), // Utilisez $post au lieu de $recentPosts
                'image' => $post->image,
                'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'), // Format français
                'updated_at' => Carbon::parse($post->updated_at)->format('d/m/Y'), // Format français
            ];
        });

        return response()->json($response);
    }


    public function create()
    {
        $visibility = ['non', 'oui'];
        $categorie = Category::all()->where('is_visible', '=', true)
            ->pluck('name', 'id');

        return Inertia::render('Admin/Posts/Create', [
            'category' => $categorie,
            'visibility' => $visibility
        ]);
    }

    // Fonction permettant d'afficher les posts par leur slug
    public function showArticle($slug)
    {
        $selectedPost = Post::where('slug', $slug)->firstOrFail();

        return Inertia::render('Post', [
            'post' => [
                'id' => $selectedPost->id,
                'title' => $selectedPost->title,
                'slug' => $selectedPost->slug,
                'content' => $selectedPost->content,
                'author' => User::find($selectedPost->blog_author_id),
                'category' => Category::find($selectedPost->blog_category_id),
                'image' => $selectedPost->image,
                'created_at' => Carbon::parse($selectedPost->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($selectedPost->updated_at)->format('d/m/Y'),
            ],
        ]);
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

        dd($request);
        if ($request->hasFile('test')) {
            dd(true);
        } else {
            dd(false);
        }
        return redirect()->route('posts.index')
            ->with('message', 'post créer avec succes.');
    }

}
