<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/{id?}', 'HomeController@index')->name('home.index');


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/1/register', 'RegisterController@show')->name('register.show');
        Route::post('/1/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/1/login', 'LoginController@show')->name('login.show');
        Route::post('/1/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/1/logout', 'LogoutController@perform')->name('logout.perform');
        /**
         * Edit Routes
         */
        #Route::get('/{id}/edit', 'HomeController@index')->name('edit.index');
        Route::post('/{id}/edit', 'HomeController@edit')->name('home.edit');

    });
});
