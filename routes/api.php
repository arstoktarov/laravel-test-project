<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('v1\Rest')->prefix('v1')->group(function() {

    Route::prefix('auth')->group(function () {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
        Route::post('profile', 'AuthController@updateProfile');

    });

    Route::post('categories/{category}/update', 'CategoryController@update');
    Route::resource('categories', 'CategoryController')->except(
        'create', 'edit', 'update'
    );

    Route::post('products/{product}/update', 'ProductController@update');
    Route::resource('categories.products', 'ProductController')->except(
        'create', 'edit', 'update'
    )->shallow();

});