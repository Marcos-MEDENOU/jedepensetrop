<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    //show function

    public function show (User $user){
        $data=$user::all();
        // dd($user);
        return Inertia::render('UserViews/Main', [
            'user'=>$data
        ]);
    }
}
