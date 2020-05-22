<?php

use Illuminate\Support\Facades\Route;

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
    return view('about');
})->name('about');

// here, we modify authentications routes, It will not let user
// registeration or password reset
Auth::routes([
    'register' => false,
    'reset' => false
]);


// can middleware will only allow the admin user to visit this route
// This middleware gate is defined in App\Providers\AuthServiceProvider
Route::get('home/{any?}', 'ProjectCategoryController@index')
    ->middleware('can:visit-admin-panel')
    ->name('home')
    ->where('any', '.*');

// display projects
Route::get('portfolio/{any?}', 'ProjectCategoryController@index')
    ->name('portfolio')
    ->where('any', '.*');
