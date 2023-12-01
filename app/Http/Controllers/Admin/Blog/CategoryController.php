<?php

namespace App\Http\Controllers\Admin\Blog;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin\Blog\Category;
use App\Models\User;
// use BalajiDharma\LaravelAdminCore\Actions\User\CreateUser;
use BalajiDharma\LaravelAdminCore\Actions\User\UpdateUser;
use BalajiDharma\LaravelAdminCore\Requests\StoreUserRequest;
use BalajiDharma\LaravelAdminCore\Requests\UpdateUserRequest;
use FFI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use League\Flysystem\Visibility;

class CategoryController extends Controller
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
        $categorie = (new Category)->newQuery();

        if (request()->has('search')) {
            $categorie->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $categorie->orderBy($attribute, $sort_order);
        } else {
            $categorie->latest();
        }

        $categorie = $categorie->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Category/Index', [
            'categorie' => $categorie,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('category create'),
                'edit' => Auth::user()->can('category edit'),
                'delete' => Auth::user()->can('category delete'),
            ]
        ]);
    }

    public function getCategories()
    {
        try {
            $categories = Category::whereHas('posts')
                ->get();

            return $categories;
        } catch (\Exception $th) {
            dd($th);
        }

    }

    public function fetchCategories()
    {
        try {
            $categories = Category::whereHas('posts')
                ->get();


            return response()->json( $categories);
        } catch (\Exception $th) {
            dd($th);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // $roles = Role::all()->pluck("name","id");
        $visibility = ['non', 'oui'];

        return Inertia::render('Admin/Category/Create', [
            'visibility' => $visibility,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @param  CreateUser  $createUser
     * @return \Illuminate\Http\Response
     */

    //  public function handle($data): Category
    //  {
    //     $categorie = Category::create([
    //         'name'=>  $data->name,
    //         'slug'=>  $data->slug,
    //         'description'=> $data->description,
    //         'seo_title'=> $data->slug,
    //         'seo_description'=>$data->seo_description,
    //         'is_visible'=> $data->seo_description
    //     ]);

    //      return $categorie;
    //  }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            // 'seo_title' => $request->slug,
            // 'seo_description' => $request->seo_description,
            // 'is_visible' => ($request->is_visible == "oui") ? true : false
        ]);

        return redirect()->route('category.index')
            ->with('message', 'catégorie créer avec succes.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Category  $category
     * @return \Inertia\Response
     */
    public function show(Category $category)
    {
        // $category = Category::all()->pluck("name","id");
        // // $roles = Role::all()->pluck("name","id");
        // // $userHasRoles = array_column(json_decode($category->roles, true), 'id');
        // dd($category);

        return Inertia::render('Admin/Category/Show', [
            'categorie' => $category,
            // 'roles' => $roles,
            // 'userHasRoles' => $userHasRoles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog\Category  $category
     * @return \Inertia\Response
     */
    public function edit(Category $category)
    {

        $all_visibility = [
            'non',
            'oui'
        ];
        $visibility = [];

        if ($category->is_visible) {
            $visibility = 1;
        } else {
            $visibility = 0;
        }
        ;
        return Inertia::render('Admin/Category/Edit', [
            'categorie' => $category,
            'all_visibility' => $all_visibility,
            'visibility' => $visibility,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            // 'seo_title' => $request->slug,
            // 'seo_description' => $request->seo_description,
            // 'is_visible' => $request->visibility
        ]);

        return redirect()->route('category.index')
            ->with('message', 'mise a jour catégorie éffectué avec succes.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('message', __('Category deleted successfully'));
    }
}
