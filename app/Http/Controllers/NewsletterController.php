<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMailNotify;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

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

        $newsletters = $newsletters->paginate(10)->onEachSide(2)->appends(request()->query());

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

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $question = $request->question;

            // Vérifiez si l'e-mail n'existe pas déjà dans la table
            if (!Newsletter::where('email', $email)->exists()) {
                // Enregistrez l'e-mail et la question dans la table
                Newsletter::create(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'question' => $question]);
                $data = [
                    'subject' => 'Jedepensetrop.fr mail delivery',
                    'name' => $firstname . ' ' . $lastname,
                ];

                try {

                    Mail::to($email)->send(new NewsletterMailNotify($data));

                    return response()->json([

                        'errorMessage' => '',
                        'successMessage' => 'Nous avons pris en compte votre soumission. Un message vous a été envoyé votre boîte gmail',
                    ]);
                } catch (Exception $th) {
                    return response()->json([

                        'errorMessage' => '',
                        'successMessage' => 'Vérifier la validité de votre adresse email',
                    ]);
    
                }

            } else {
                Newsletter::create(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'question' => $question]);
                return response()->json([
                    'successMessage' => 'Vous etes déja inscrit une fois a notre newsletter, nous vous reviendrons pour vore nouvelle préoccupation.',
                    'errorMessage' => '',
                ]);
            }

        } catch (\Exception $th) {
            return response()->json([

                'successMessage' => '',
                'errorMessage' => 'Error' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeViaHome(Request $request)
    {

        try {

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $question = $request->question;

            // Vérifiez si l'e-mail n'existe pas déjà dans la table
            if (!Newsletter::where('email', $email)->exists()) {
                // Enregistrez l'e-mail et la question dans la table
                Newsletter::create(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'question' => $question]);

                $data = [
                    'subject' => 'Jedepensetrop.fr mail delivery',
                    'name' => $firstname . ' ' . $lastname,
                ];

                try {

                    Mail::to($email)->send(new NewsletterMailNotify($data));

                    return response()->json([

                        'errorMessage' => '',
                        'successMessage' => 'Nous avons pris en compte votre soumission. Un message vous a été envoyé votre boîte gmail',
                    ]);
                } catch (Exception $th) {
                    return response()->json([

                        'errorMessage' => '',
                        'successMessage' => 'Vérifier la validité de votre adresse email',
                    ]);
    
                }

               
            } else {
                // Newsletter::create(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'question' => $question]);
                return response()->json([
                    'successMessage' => 'Vous etes déja inscrit une fois a notre newsletter, nous vous reviendrons pour vore nouvelle préoccupation',
                    'errorMessage' => '',
                ]);
            }

        } catch (\Exception $th) {
            return response()->json([

                'successMessage' => '',
                'errorMessage' => 'Error' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeViaHomeEmail(Request $request)
    {

        try {

            $email = $request->email;

            if (!empty($email)) {
                // Vérifiez si l'e-mail n'existe pas déjà dans la table
                if (!Newsletter::where('email', $email)->exists()) {
                    // Enregistrez l'e-mail et la question dans la table
                    Newsletter::create(['email' => $email]);

                    $data = [
                        'subject' => 'Jedepensetrop.fr mail delivery',
                        'name' =>  $email,
                    ];
    
                    try {
    
                        Mail::to($email)->send(new NewsletterMailNotify($data));
    
                        return response()->json([
    
                            'errorMessage' => '',
                            'successMessage' => 'Nous avons pris en compte votre soumission. Un message vous a été envoyé votre boîte gmail',
                        ]);
                    } catch (Exception $th) {
                        return response()->json([
    
                            'errorMessage' => '',
                            'successMessage' => 'Vérifier la validité de votre adresse email',
                        ]);
        
                    }

                } else {
                    // Newsletter::create(['email' => $email]);
                    return response()->json([
                        'successMessage' => 'Vous etes déja inscrit une fois a notre newsletter',
                        'errorMessage' => '',
                    ]);
                }

            } else {
                return response()->json([
                    'successMessage' => 'Vous n\'avez renseigner aucune addresse électronique',
                    'errorMessage' => '',
                ]);
            }

        } catch (\Exception $th) {
            return response()->json([

                'successMessage' => '',
                'errorMessage' => 'Error' . $th->getMessage(),
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
