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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/request','User\RequestController@store')->name('new.request');

    Route::get('/requests/{request}','User\RequestController@show');

    Route::post('/toggle-seen', 'User\RequestController@toggleSeen' );

});

