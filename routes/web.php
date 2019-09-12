<?php

Auth::routes();

Route::get  ('/home', 'HomeController@index')->name('home');

Route::get  ('/edit_login',                       'EditLogin@index');
Route::post ('/edit_login',                       'EditLogin@login');

Route::get  ('/forgot',                           'ForgotConfNum@index');
Route::post ('/forgot',                           'ForgotConfNum@CheckEmail');

Route::get  ('/',                                 'Registrations@index');
Route::get  ('/registration',                     'Registrations@index');
Route::get  ('/registration/{con_num}/{id}/edit', 'Registrations@show');
Route::post ('/registration',                     'Registrations@store');
