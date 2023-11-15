<?php

namespace App\Http\Controllers\Admin\Blog;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Author;
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

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:author list', ['only' => ['index', 'show']]);
        $this->middleware('can:author create', ['only' => ['create', 'store']]);
        $this->middleware('can:author edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:author delete', ['only' => ['destroy']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $author = (new Author)->newQuery();;

        if (request()->has('search')) {
            $author->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $author->orderBy($attribute, $sort_order);
        } else {
            $author->latest();
        }

        $author = $author->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Author/Index', [
            'authors' => $author,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('author create'),
                'edit' => Auth::user()->can('author edit'),
                'delete' => Auth::user()->can('author delete'),
            ]
        ]);
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

        return Inertia::render('Admin/Author/Create', [
            // 'visibility' => $visibility,
        ]);
    }

    public function edit(Author $author)
    {
        return Inertia::render('Admin/Author/Edit',[
            'authors'=> $author
        ] );
    }

    public function show(Author $author)
    {
        // $category = Category::all()->pluck("name","id");
        // // $roles = Role::all()->pluck("name","id");
        // // $userHasRoles = array_column(json_decode($category->roles, true), 'id');
        // dd($category);

        return Inertia::render('Admin/Author/Show', [
            'authors' => $author,
            // 'roles' => $roles,
            // 'userHasRoles' => $userHasRoles,
        ]);
    }
    
    public function update(Request $request, Author $author)

    {

        dd($request);
        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'email' => $request->email,
        ]);

        return redirect()->route('author.index')
            ->with('message', 'mise a jour auteur éffectué avec succes.');
    }


    public function store(Request $request)

    {
        Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
         
        ]);

        return redirect()->route('author.index')
            ->with('message', 'auteur créer avec succes.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('author.index')
            ->with('message', __('auteur deleted successfully'));
    }

}
