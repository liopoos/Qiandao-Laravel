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

Route::group([], function ($router) {
    $router->get('{uri}', [
        'uses' => 'ApiController@gateway'
    ]);
    $router->post('{uri}', [
        'uses' => 'ApiController@gateway'
    ]);
    $router->put('{uri}', [
        'uses' => 'ApiController@gateway'
    ]);
    $router->delete('{uri}', [
        'uses' => 'ApiController@gateway'
    ]);
});