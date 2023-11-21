<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;
use Carbon\Carbon;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $user = auth()->user();

            // Vérifier si l'utilisateur est connecté
            if ($user) {
                // Vérifier si l'utilisateur a déjà désaimé le post
                Comment::create([
                    'content' => $request->input('content'),
                    'user_id' => $user->id,
                    'post_id' => $request->input('post_id'),
                    'parent_comment_id' => $request->input('parent_comment_id'),
                ]);
                return response()->json([
                    'errorMessage' => '',
                    'successMessage' => 'Commentaire ajouté avec succès',
                    'commentaires' => self::show($$request->input('post_id'))
                ]);
            } else {
                // L'utilisateur n'est pas connecté, envoyer un message
                return response()->json([
                    'successMessage' => '',
                    'errorMessage' => 'Veuillez vous connecter pour commenter le post.',

                ]);
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        try {
            // Récupérer les trois derniers commentaires du post qui n'ont pas de parent
            $comments = Comment::where('post_id', $postId)
                ->whereNull('parent_comment_id')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->with('user') // Charger les informations de l'utilisateur
                ->get();

            // Charger les réponses pour chaque commentaire
            $comments->load('childComments.user'); // Assurez-vous que la relation est définie dans le modèle Comment

            // Formater la date en français
            // $comments = $comments->map(function ($comment) {
            //     $comment->created_at =  Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at->toDateTimeString())->format('d/m/Y H:i:s');
            //     return $comment;
            // });




            return response()->json($comments);
        } catch (\Exception $th) {
            // Gérer l'exception ici
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'content' => 'required|string',
        ]);
        $comment = Comment::findOrFail($id);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return response()->json(['success' => '']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['success' => '']);
    }
}
