<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Category;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
        $posts = (new Post)->newQuery()->join('blog_category', 'blog_post.blog_category_id', '=', 'blog_category.id')->select('blog_post.*', 'blog_category.name as category_name');

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
        $categorie = Category::all()->where('is_visible', '=', true)
            ->pluck('name', 'id');

        return Inertia::render('Admin/Posts/Create', [
            'category' => $categorie,
            'visibility' => $visibility,
        ]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit',[
            'posts'=> $post
        ] );
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

}
