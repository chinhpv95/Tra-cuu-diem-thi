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

Route::any('autocomplete', [
    'as' => 'search_queries',
    'uses' => 'SearchController@autoComplete'
]);

Route::post('result', [
    'as' => 'search_result',
    'uses' => 'SearchController@result'
]);

//Route::get('login', [
//    'as' => 'login',
//    'uses' => 'LoginController@index'
//]);

//Route::post('login', [
//    'as' => 'login',
//    'uses' => 'LoginController@index'
//]);

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
    Route::post('/admin/getExcel', ['as' => 'getExcel', 'uses' => 'AdminController@getExcel']);
    Route::post('/admin/getClass', ['as' => 'getClass', 'uses' => 'AdminController@getClass']);
    Route::get('/admin/getClass', ['as' => 'getClass', 'uses' => 'AdminController@getClass']);

    Route::get('/upload/{class_id}', ['as' => 'upLoad', 'uses' => 'AdminController@upLoad']);
    Route::post('/upload/{class_id}', ['as' => 'upLoad', 'uses' => 'AdminController@upLoad']);

    Route::get('/download/{class_id}', ['as' => 'downLoad', 'uses' => 'AdminController@downLoad']);
    Route::post('/download/{class_id}', ['as' => 'downLoad', 'uses' => 'AdminController@downLoad']);

    Route::get('/delete/{user_id}', ['as' => 'delete', 'uses' => 'AdminController@delete']);
    Route::post('/delete/{user_id}', ['as' => 'delete', 'uses' => 'AdminController@delete']);

    Route::any('/profile/{user_id}', ['as' => 'profile', 'uses' => 'AdminController@profile']);
    Route::any('profile/updateName', ['as' => 'updateName', 'uses' => 'AdminController@updateName']);
    Route::any('profile/updateEmail', ['as' => 'updateEmail', 'uses' => 'AdminController@updateEmail']);
    Route::any('profile/updatePassword', ['as' => 'updatePassword', 'uses' => 'AdminController@updatePassword']);
});
