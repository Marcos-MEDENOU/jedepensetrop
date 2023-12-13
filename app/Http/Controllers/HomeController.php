<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function home(CategoryController $categoryController, PostController $postController)
    {
        $user = Auth::user();
        $categories = $categoryController->getCategories();
        $LatestPost = $postController->getLatestPost();
        $PreviousThreePosts = $postController->getPreviousThreePosts();
        $ThreeByCategory = $postController->showThreeByCategory();
        $TopThreePosts = $postController->getTopThreePosts();



        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user' => $user,
            'categories' => $categories,
            'LatestPost' => $LatestPost,
            'PreviousThreePosts' => $PreviousThreePosts,
            'ThreeByCategory' => $ThreeByCategory,
            'TopThreePosts' => $TopThreePosts,
        ]);
    }
}
