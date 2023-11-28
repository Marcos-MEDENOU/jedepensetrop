<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class NewsletterController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:newsletters list', ['only' => ['index', 'show']]);
        $this->middleware('can:newsletters create', ['only' => ['create', 'store']]);
        $this->middleware('can:newsletters edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:newsletters delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = (new Newsletter)->newQuery();

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
            $newsletters->orderBy($attribute, $sort_order);
        } else {
            $newsletters->latest();
        }



        $newsletters = $newsletters->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Newsletter/Index', [
            'newsletters' => $newsletters,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('newsletters create'),
                'edit' => Auth::user()->can('newsletters edit'),
                'delete' => Auth::user()->can('newsletters delete'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
// dd($request->all());
            $email = $request->email; // Remplacez ceci par l'e-mail que vous souhaitez enregistrer
            $question = $request->question; // Remplacez ceci par la question le cas échéant

            // Vérifiez si l'e-mail n'existe pas déjà dans la table
            if (!Newsletter::where('email', $email)->exists()) {
                // Enregistrez l'e-mail et la question dans la table
                Newsletter::create(['email' => $email, 'question' => $question]);
                return response()->json([

                    'errorMessage' => '',
                    'successMessage' => 'Email enrégistrer avec succès'
                ]);
            }

            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Email déjà enrégistré.'
            ]);
        } catch (\Exception $th) {
            return response()->json([

                'successMessage' => '',
                'errorMessage' => 'Error' . $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('newsletter.index')
            ->with('message', __('Newsletter deleted successfully'));
    }
}
