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

    // blog private routes
});


// blog public route
Route::get('blogs', 'BlogController@paginateBlog');

Route::get('blogsByTag/{tag}', 'BlogController@blogByTag');

Route::get('blog/{blog}', 'BlogController@blogById');
