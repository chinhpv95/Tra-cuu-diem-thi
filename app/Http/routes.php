<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/', [
    'as' => 'search',
    'uses' => 'SearchController@index'
]);

Route::get('admin', [
    'as' => 'admin',
    'uses' => 'AdminController@index'
]);

/*
Route::get('login', [
    'as' => 'login',
    'uses' => 'LoginController@index'
]);

Route::post('login', [
    'as' => 'login',
    'uses' => 'LoginController@index'
]);*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::post('/admin/addUser', ['as' => 'addUser', 'uses' => 'AdminController@addUser']);

});
