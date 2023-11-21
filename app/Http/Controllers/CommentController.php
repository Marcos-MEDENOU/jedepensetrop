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
           
            $user = auth()->user();

            if ($user) {
                $comment = Comment::create([
                    'content' => $request->input('content'),
                    'user_id' => $user->id,
                    'post_id' => $request->input('post_id'),
                    'parent_comment_id' => $request->input('parent_comment_id'),
                ]);

                // Ajouter le nouveau commentaire à la liste des commentaires
                $comments = self::show($request->input('post_id'));


                return response()->json([
                    'errorMessage' => '',
                    'successMessage' => 'Commentaire ajouté avec succès',
                    'commentaires' => $comments,
                ]);
            } else {
                return response()->json([
                    'successMessage' => '',
                    'errorMessage' => 'Veuillez vous connecter pour commenter le post.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

            $commentsCount = Comment::where('post_id', $postId)->count();

            // Charger les réponses pour chaque commentaire
            $comments->load('childComments.user'); // Assurez-vous que la relation est définie dans le modèle Comment

            return response()->json(
                [
                    'comments' => $comments,
                    'count' => $commentsCount,
                ]
            );
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
        // Récupérer l'élément à éditer depuis la base de données
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'content' => 'required|string',
        ]);
        $comment = Comment::findOrFail($request->commentId);

        $comment->update([
            'content' => $request->content,
        ]);

        // Ajouter le nouveau commentaire à la liste des commentaires
        $comments = self::show($request->post_id);


        return response()->json([
            'commentaires' => $comments,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // dd  ($request->all());
            $comment = Comment::findOrFail($request->commentId);
            $comment->delete();


            // Ajouter le nouveau commentaire à la liste des commentaires
            $comments = self::show($request->post_id);


            return response()->json([
                'commentaires' => $comments,
            ]);
        } catch (\Exception $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }
}
