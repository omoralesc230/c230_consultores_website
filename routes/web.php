<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/aboutus', function () {
    return view('welcome');
});
Route::get('/whatwedo', function () {
    return view('welcome');
});
Route::get('/posts/{id}', function () {
    return view('welcome');
});
Route::get('/vacancies', function () {
    return view('welcome');
});
Route::get('/vacancy/{id}', function () {
    return view('welcome');
});
Route::post('/application', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );
