<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// list Posts
Route::get('posts' , 'Api\PostController@index');

// list Single Post
Route::get('post/{id}' , 'Api\PostController@show');

// Create New Post
Route::post('post' , 'Api\PostController@store');

// Update Post
Route::put('post' , 'Api\PostController@store');

// Delete Post
Route::delete('post/{id}' , 'Api\PostController@destroy');
