<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }
}
