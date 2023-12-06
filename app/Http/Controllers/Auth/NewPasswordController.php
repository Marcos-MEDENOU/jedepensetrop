<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {

        //Verification si le token est bien présent dans la table
        $checkExistData = DB::table('password_reset_tokens')->where('token', $request->route('token'))->exists();

        //Récupération du created_at de la ligne récupérer
        $created_at = "2023-12-05";
        if ($checkExistData) {
            $created_at = DB::table('password_reset_tokens')
                ->where('token', $request->route('token'))
                // ->where('created_at', '>', now()->subMinutes(config('auth.passwords.users.expire')))
                ->pluck('created_at'); // Récupère la première correspondance
        }

        //Comparaison du expired_at avec Carbon::now() pour checker si la le moment d'expiration est arrivé ou pas
        if( $created_at[0] >  now()->subMinutes(config('auth.passwords.users.expire'))){
            // dd("time");
            return Inertia::render('Auth/ResetPassword', [
                
                'email' => $this->getEmailFromPasswordResetToken($request->route('token')),
                'token' => $request->route('token'),
            ]);
        }else{
            // dd("times");
            return Inertia::render('Auth/ResetPassword', [
                'email' => $this->getEmailFromPasswordResetToken($request->route('token')),
                'token' => $request->route('token'),
                'status'=> "expired",
            ]);
        }
    }

    public function getEmailFromPasswordResetToken($token)
    {
        // Utilisez la façade DB pour exécuter une requête SQL
        $result = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first(); // Récupère la première correspondance

        // Si une correspondance est trouvée, retourne l'adresse e-mail, sinon retourne null
        return $result ? $result->email : null;
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'email' => "required|email|exists:users",
            'password' => "required|string|min:6|confirmed",
            'password_confirmation' => "required",
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                "email" => $request->email,
                "token" => $request->token,
            ])->first();

        if (!$updatePassword) {
            return response()->json('Lien expiré, demandez un nouveau');
        } else {
            User::where("email", $request->email)->update([
                "password" => Hash::make($request->password),
            ]);

            DB::table('password_reset_tokens')
                ->where([
                    "email" => $request->email,
                ])->delete();
            return redirect()->to(route("login"))->with("success", "Password réinitialiser avec success");
        }
       
    }
}
