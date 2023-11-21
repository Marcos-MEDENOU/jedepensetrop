<?php

namespace App\Http\Middleware;

use App\Models\User;
use BalajiDharma\LaravelMenu\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string | null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user(); // Utilisez $request->user() pour éviter l'erreur lors de la déconnexion

        $role = $user ? $user->roles->pluck('name')[0] : 'none';

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'navigation' => [
                'menu' => Menu::getMenuTree($role),
                // 'menu' => Menu::getMenuTree($role),
                // 'menu' => Menu::getMenuTree(Role::where('id', Auth::user()->id)->firstOrFail()['name'])
            ],
        ]);
    }
}
