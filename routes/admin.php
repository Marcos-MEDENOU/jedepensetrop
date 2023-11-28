<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Admin', 'App\Http\Controllers\Admin\Blog',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth'],
], function () {
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('menu', 'MenuController')->except([
        'show',
    ]);
    Route::resource('menu.item', 'MenuItemController');
    Route::get('edit-account-info', 'UserController@accountInfo')->name('admin.account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('admin.account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('admin.account.password.store');
});
Route::group([
    'namespace' => 'App\Http\Controllers\Admin\Blog',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth'],
], function () {

    Route::resource('category', 'CategoryController');
    Route::resource('author', 'AuthorController');
    Route::resource('posts', 'PostController');
    Route::resource('scrapping', 'ScrapperController');

});
Route::group([
    'namespace' => 'App\Http\Controllers\Admin\Scrapper',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth'],
], function () {

    Route::resource('scrapping', 'ScrapperController');
});
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth'],
], function () {

    Route::resource('newsletter', 'NewsletterController');
});
