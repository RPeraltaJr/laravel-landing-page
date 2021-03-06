<?php

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

Route::get('/', 'SubmissionsController@index');
Route::post('/', 'SubmissionsController@store');
Route::get('/thank-you', function () {
    return view('thank');
});

// * Dashboard Routes
Auth::routes(
    // ['register' => false]
);

Route::get('/admin', 'HomeController@index');
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});

Route::resource('/submissions', 'HomeController');
Route::get('/export', 'HomeController@export');

// * Search Form (use [any] to allow pagination usage)
Route::any('/admin/search', 'SearchController@filter');