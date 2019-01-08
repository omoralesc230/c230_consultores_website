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

Route::apiResources(['user' => 'API\UserController'])->middleware('verified');
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');

Route::apiResources(['media' => 'API\MediaController']);

Route::apiResources(['vacancy' => 'API\VacancyController']);
Route::get('findVacancy', 'API\VacancyController@search');

Route::apiResources(['application' => 'API\ApplicationController']);

Route::apiResources(['post' => 'API\PostController'])->middleware('verified');
Route::get('featured', 'API\PostController@featuredPosts');
Route::put('ordered', 'API\PostController@updatePosts');
Route::put('linkedcostumers', 'API\PostController@costumersLinked');

Route::apiResources(['costumer' => 'API\CostumerController']);

Route::apiResources(['section' => 'API\SectionController']);
Route::put('sectionsOrdered', 'API\SectionController@updateSections');

Route::apiResources(['item' => 'API\ItemController']);
