<?php

use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentAiController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use Inertia\Inertia;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewsletterMailNotify;
use App\Http\Controllers\NewsletterMailNotifyController;

//image
use App\Http\Controllers\UploadTemporaryImageController;
use App\Http\Controllers\DeleteTemporaryImageController;
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

Route::get('/', [HomeController::class, 'home'])->name('home.index');


Route::get('/contentAi', [ContentAiController::class, 'index'])->name('contentAi.index');
Route::post('/api', [ContentAiController::class, 'test'])->name('contentAi.test');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified','super-admin'])->group(function () {
    Route::post('/editorUpload', [PostController::class, 'editorUpload']);
});

Route::middleware([ 'auth', 'role:admin|super-admin|writer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

Route::post('/upload', [ImageUploadController::class, 'store']);
Route::get('/getcategories', [CategoryController::class, 'fetchCategories'])->name('getcategories');
Route::get('/latestPost', [PostController::class, 'getLatestPost'])->name('latestPost');
Route::get('/previousThreePosts', [PostController::class, 'getPreviousThreePosts'])->name('previousThreePosts');
Route::get('/post/{slug}', [PostController::class, 'showArticle'])->name('post.show');
Route::get('/showThreeByCategory', [PostController::class, 'showThreeByCategory'])->name('showThreeByCategory');
Route::get('/category_posts/{slug}', [PostController::class, 'getCategoryWithPosts'])->name('category_posts');
Route::post('/newsletters/store', [NewsletterController::class, 'storeViaHome'])->name('newsletters.store');
Route::post('/newslettersHome/store', [NewsletterController::class, 'storeViaHomeEmail'])->name('newslettersHome.store');
Route::get('/post/previous/{id}', [PostController::class, 'getPreviousPost'])->name('previous.post');;
Route::get('/post/next/{id}', [PostController::class, 'getNextPost'])->name('next.post');;
Route::get('/posts/has-previous/{postId}', [PostController::class, 'hasPreviousPost'])->name('has-previous.post');
Route::get('/posts/has-next/{postId}', [PostController::class, 'hasNextPost'])->name('has-next.post');
Route::post('/posts/{postId}/like', [LikeDislikeController::class, 'like']);
Route::post('/posts/{postId}/dislike', [LikeDislikeController::class, 'dislike']);
Route::get('/search', [SearchController::class, 'index'])->name('search');



Route::get('/comments/{id}', [CommentController::class, 'show'])->name('comments.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comments-reply', [CommentController::class, 'store'])->name('comments.reply');
Route::post('/comments/update', [CommentController::class, 'update'])->name('comments.update');
Route::post('/comments/delete', [CommentController::class, 'destroy'])->name('comments.delete');
Route::get('/comments/edit/{id}', [CommentController::class, 'edit'])->name('comments.edit');

require __DIR__.'/auth.php';


# Socialite URLs

// La page où on présente les liens de redirection vers les providers
// Route::get("login-register", "SocialiteController@loginRegister");
Route::get('login-register', [SocialiteController::class, 'loginRegister']);
// La redirection vers le provider
// Route::get("redirect/{provider}", "SocialiteController@redirect")->name('socialite.redirect');
Route::get('redirect/{provider}/', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('callback/{provider}/', [SocialiteController::class, 'callback'])->name('socialite.callback');


Route::post('/upload', UploadTemporaryImageController::class);
Route::delete('/revert/{folder}', DeleteTemporaryImageController::class);


Route::get('/send', [NewsletterMailNotifyController::class, 'index']);
// Route::get('/send', function(){
//    $name = "welcome";
//    Mail::to('marcosmedenou@gmail.com')->send(new NewsletterMailNotify($name));
// });