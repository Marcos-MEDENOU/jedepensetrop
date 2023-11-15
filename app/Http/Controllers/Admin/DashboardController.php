<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin\Blog\Post;
use App\Models\User;
use BalajiDharma\LaravelAdminCore\Actions\User\CreateUser;
use BalajiDharma\LaravelAdminCore\Actions\User\UpdateUser;
use BalajiDharma\LaravelAdminCore\Requests\StoreUserRequest;
use BalajiDharma\LaravelAdminCore\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function show(User $user, Post $post){
        //This function has uses to count all users in database (admin incluses)
        $users= $user::all()->count();
        $posts= $post::all()->count();
        $allusers= $user::all();
        return Inertia::render('Dashboard', [
            'users' => $users,    
            'posts' => $posts,    
            'listusers'=> $allusers,
        ]);
    }
}
