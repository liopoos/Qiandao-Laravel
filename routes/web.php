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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('index', 'HomeController@doc');
Route::any('login', [
    'as' => 'login', 'uses' => 'AuthController@login'
]);
Route::get('logout', 'AuthController@logout');
Route::any('register', 'AuthController@register');

Route::get('list', 'HomeController@list');
Route::get('api/doc', 'HomeController@api');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'UserController@dashboard');
    Route::any('creat', 'TemplateController@creat');
    Route::get('template/{id}', 'TemplateController@detail');
    Route::any('add/{id}', 'UserController@add');
    Route::get('log/{id?}', 'UserController@log');
    Route::get('task/{id}', 'UserController@task');
    Route::get('delete/{type}/{id}', 'UserController@delete');
    Route::get('message', 'UserController@message');
    Route::get('test/{id}', 'UserController@test');
    Route::get('do/{id?}', 'HomeController@do');
});


Route::prefix('api')->middleware('apis')->group(function () {
    Route::get('user', 'ApiController@user');
    Route::get('task/list', 'ApiController@taskList');
    Route::get('template/list', 'ApiController@templateList');
    Route::get('log/{id?}', 'ApiController@log');
    Route::post('do/{id?}', 'ApiController@do');
});