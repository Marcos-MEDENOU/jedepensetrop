<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Socialite;
use Illuminate\Support\Facades\DB;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = ["google", "github", "facebook"];

    # La vue pour les liens vers les providers
    public function loginRegister()
    {
        return view("socialite.login-register");
    }

    # redirection vers le provider
    public function redirect(Request $request)
    {

        $provider = $request->provider;

        // On vérifie si le provider est autorisé
        if (in_array($provider, $this->providers)) {

            return Socialite::driver('google')->redirect(); // On redirige vers le provider
        }
        abort(404); // Si le provider n'est pas autorisé
    }

    // Callback du provider
    public function callback(Request $request)
    {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

            // Les informations provenant du provider
            $data = Socialite::driver($request->provider)->user();

            # Social login - register
            $email = $data->getEmail(); // L'adresse email
            $name = $data->getName(); // le nom
            $image = $data->getAvatar();

            # 1. On récupère l'utilisateur à partir de l'adresse email
            $user = User::where("email", $email)->first();

            # 2. Si l'utilisateur existe
            if (isset($user)) {

                // Mise à jour des informations de l'utilisateur
                $user->name = $name;
                $user->save();

                # 3. Si l'utilisateur n'existe pas, on l'enregistre
            } else {

                // Enregistrement de l'utilisateur
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'image'=> $image,
                    'password' => bcrypt($email), // On attribue un mot de passe
                ]);

                //attribution d'un role a l'utilisateur
                DB::table('model_has_roles')->insert([
                    'role_id' => Role::where('name', 'user')->firstOrFail()['id'], // Remplacez par l'ID du rôle que vous souhaitez attribuer
                    'model_id' =>  User::where('email', $email)->firstOrFail()['id'], // Remplacez par l'ID de l'entité à laquelle vous attribuez le rôle
                    'model_type' => 'App\\Model\\User', // Remplacez par le modèle (classe) associé à l'entité
                ]);
            }

            # 4. On connecte l'utilisateur
            auth()->login($user);

           

            # 5. On redirige l'utilisateur vers /home
            if (auth()->check()) {
                return redirect(route('home.index'));
            }

        }
        abort(404);
    }
}
