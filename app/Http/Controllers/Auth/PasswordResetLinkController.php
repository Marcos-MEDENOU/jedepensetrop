<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
            'successMessage' => session('success'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        if (!DB::table('password_reset_tokens')->where('email', $request->email)->exists()) {

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $data = [
                'subject' => 'Réinitialisation mot de passe jedepensetrop.fr',
                'token' => $token,
                'name' => User::where('email', $request->email)->pluck('name'),
            ];

            Mail::to($request->email)->send(new ForgetPasswordMailNotify($data));

            return redirect()->to(route("password_reset.confirm"))->with("default", "Default message");
        } else {
            //le mail se trouve dans la base de donnée

            $checkExistData = DB::table('password_reset_tokens')->where('email', $request->email)->pluck('created_at');

            if ($checkExistData[0] > now()->subMinutes(config('auth.passwords.users.expire'))) {
                return redirect()->to(route("password_reset.confirm"))->with("success", "success data");
                // return Inertia::render('Auth/ConfirmEmail');
            } else {
                // return redirect()->to(route("password_reset.confirm"))->with("expiry", "Password expiré");
                DB::table('password_reset_tokens')
                    ->where([
                        "email" => $request->email,
                    ])->delete();
                return redirect()->to(route("password_reset.confirm"))->with("expiry", "Password expiré");
            }

        }
    }

    public function confirm(Request $request)
    {

        return Inertia::render('Auth/ConfirmEmail', [
            'successMessage' => session('success'),
            'expiryMessage' => session('expiry'),
            'defaultMessage' => session('default'),

        ]);
    }
}
