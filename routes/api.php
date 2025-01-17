<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function () {

    // project category routes
    Route::post('project/category/add', 'ProjectCategoryController@store');

    Route::delete('project/category/delete/{projectCategory}', 'ProjectCategoryController@destroy');

    Route::put('project/category/update/{projectCategory}', 'ProjectCategoryController@update');

    // project routes
    Route::get('projects', 'ProjectController@index');

    Route::delete('project/delete/{project}', 'ProjectController@destroy');

    Route::post('project/add', 'ProjectController@store');

    Route::put('project/update/{project}', 'ProjectController@update');

    Route::post('project/image/add', 'ProjectController@storeImage');

    Route::delete('project/image/delete', 'ProjectController@deleteImage');

    // blog tag routes
    Route::get('blog/tags', 'BlogTagController@index');

    Route::post('blog/tags/add', 'BlogTagController@store');

    Route::put('blog/tags/update/{tag}', 'BlogTagController@update');

    Route::delete('blog/tags/delete/{tag}', 'BlogTagController@destroy');

    // blog routes
    Route::get('blogs/all', 'BlogController@getBlogs');

    Route::post('blogs/header/image/add', 'BlogController@storeHeaderImage');

    Route::delete('blogs/header/image/delete', 'BlogController@deleteHeaderImage');

    Route::post('blogs/add', 'BlogController@store');

    Route::put('blogs/update/{blog}', 'BlogController@update');

    Route::delete('blogs/delete/{blog}', 'BlogController@destroy');
});


// blog public route
Route::get('blogs', 'BlogController@paginateBlog');

Route::get('blogsByTag/{tag}', 'BlogController@blogByTag');

Route::get('blog/{blog}', 'BlogController@blogById');
