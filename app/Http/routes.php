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

Route::any('manytomany', [
    'as' => 'manytomany',
    'uses' => 'AdminController@manytomany'
]);

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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::post('/admin/addUser', ['as' => 'addUser', 'uses' => 'AdminController@addUser']);
    Route::post('/admin/getExcel', ['as' => 'getExcel', 'uses' => 'AdminController@getExcel']);
    Route::post('/admin/getClass', ['as' => 'getClass', 'uses' => 'AdminController@getClass']);
    Route::get('/admin/getClass', ['as' => 'getClass', 'uses' => 'AdminController@getClass']);
    Route::post('/admin/addYear', ['as' => 'addYear', 'uses' => 'AdminController@addYear']);
    Route::post('admin/filter_class', ['as' => 'filter', 'uses' => 'AdminController@filter_class']);
    Route::post('admin/{year_id}/updateYear', ['as' => 'updateYear', 'uses' => 'AdminController@updateYear']);
    Route::post('admin/{user_id}/updatePermission', ['as' => 'updatePermission', 'uses' => 'AdminController@updatePermission']);
    Route::post('admin/multi_delete', ['as' => 'multi_delete', 'uses' => 'AdminController@multi_delete']);
    Route::post('admin/multi_delete_pdf', ['as' => 'multi_delete_pdf', 'uses' => 'AdminController@multi_delete_pdf']);
    Route::post('admin/multi_delete_user', ['as' => 'multi_delete_user', 'uses' => 'AdminController@multi_delete_user']);
    Route::post('admin/set_active', ['as' => 'set_active', 'uses' => 'AdminController@set_active']);

    Route::get('/upload/{class_id}', ['as' => 'upLoad', 'uses' => 'AdminController@upLoad']);
    Route::post('/upload/{class_id}', ['as' => 'upLoad', 'uses' => 'AdminController@upLoad']);

    Route::get('/download/{class_id}', ['as' => 'downLoad', 'uses' => 'AdminController@downLoad']);
    Route::post('/download/{class_id}', ['as' => 'downLoad', 'uses' => 'AdminController@downLoad']);
    Route::post('/delete/file', ['as' => 'deleteFile', 'uses' => 'AdminController@deleteFile']);

    Route::any('/profile/{user_id}', ['as' => 'profile', 'uses' => 'AdminController@profile']);
    Route::any('profile/{user_id}/updateName', ['as' => 'updateName', 'uses' => 'AdminController@updateName']);
    Route::any('profile/{user_id}/updateEmail', ['as' => 'updateEmail', 'uses' => 'AdminController@updateEmail']);
    Route::any('profile/{user_id}/updatePassword', ['as' => 'updatePassword', 'uses' => 'AdminController@updatePassword']);
    Route::post('profile/{user_id}/updateAvatar', ['as' => 'updateAvatar', 'uses' => 'AdminController@updateAvatar']);

    Route::any('/result', [
        'as' => 'search_result',
        'uses' => 'SearchController@result'
    ]);

    Route::any('/search_class', [
        'as' => 'search_class_result',
        'uses' => 'AdminController@search_class'
    ]);

    Route::any('sendemail', ['as'=>'sendEmail', 'uses'=>'AdminController@sendEmail']);

    Route::any('delete', ['as' => 'delete', 'uses' => 'AdminController@delete']);
    Route::any('delete_year', ['as' => 'delete_year', 'uses' => 'AdminController@delete_year']);
});