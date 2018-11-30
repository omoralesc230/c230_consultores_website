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

Route::apiResources(['user' => 'API\UserController']);
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');

Route::apiResources(['media' => 'API\MediaController']);

Route::apiResources(['vacancy' => 'API\VacancyController']);
Route::get('findVacancy', 'API\VacancyController@search');

Route::apiResources(['application' => 'API\ApplicationController']);

Route::apiResources(['post' => 'API\PostController']);
Route::get('featured', 'API\PostController@featuredPosts');
Route::put('ordered', 'API\PostController@updatePosts');

Route::apiResources(['costumer' => 'API\CostumerController']);
