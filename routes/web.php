<?php

/*
|--------------------------------------------------------------------------
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

Route::get  ('/home', 'HomeController@index')->name('home');


Route::get  ('/edit_login',                       'EditLogin@index');
Route::post ('/edit_login',                       'EditLogin@store');


Route::get  ('/registration',                     'Registrations@index');
Route::get  ('/registration/{con_num}/{id}/edit', 'Registrations@show');
Route::post ('/registration',                     'Registrations@store');
