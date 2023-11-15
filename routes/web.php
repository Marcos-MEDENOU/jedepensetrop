<?php

use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContentAiController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/contentAi', [ContentAiController::class, 'index'])->name('contentAi.index');
Route::post('/api', [ContentAiController::class, 'test'])->name('contentAi.test');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('/editorUpload', [PostController::class, 'editorUpload']);
});

Route::post('/upload', [ImageUploadController::class, 'store']);
Route::get('/getcategories', [CategoryController::class, 'getCategories'])->name('getcategories');
Route::get('/recent-posts', [PostController::class, 'getRecentPosts'])->name('recent-posts');
Route::get('/post/{slug}', [PostController::class, 'showArticle'])->name('post.show');

require __DIR__.'/auth.php';
