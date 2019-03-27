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

//Route::group([], function ($router) {
//    $router->get('{uri}', [
//        'uses' => 'ApiController@gateway'
//    ]);
//    $router->post('{uri}', [
//        'uses' => 'ApiController@gateway'
//    ]);
//    $router->put('{uri}', [
//        'uses' => 'ApiController@gateway'
//    ]);
//    $router->delete('{uri}', [
//        'uses' => 'ApiController@gateway'
//    ]);
//});
use Illuminate\Support\Facades\Route;

Route::get('homeland', 'HomeController@index');
Route::any('login', [
    'as' => 'login', 'uses' => 'AuthController@login'
]);
Route::get('logout', 'AuthController@logout');
Route::any('register', 'AuthController@register');

Route::get('list', 'HomeController@list');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'UserController@dashboard');
    Route::any('creat', 'TemplateController@creat');
    Route::get('template/{id}', 'TemplateController@detail');

    Route::get('add', function () {

    });
});