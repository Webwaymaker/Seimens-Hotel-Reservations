<?php

Auth::routes();

Route::get  ('/home', 'HomeController@index')->name('home');


Route::get    ('/forgot',                            'ForgotConfNum@index');
Route::post   ('/forgot',                            'ForgotConfNum@CheckEmail');

Route::get    ('/',                                  'Registrations@index');
Route::get    ('/registration',                      'Registrations@index');
Route::post   ('/registration',                      'Registrations@store');
Route::get    ('/registration/{conf_num}/{id}/edit', 'Registrations@show');
Route::put    ('/registration/{conf_num}/{id}',      'Registrations@update');
Route::delete ('/registration/{conf_num}/{id}/delete', 'Registrations@destroy');

Route::get    ('/registration_login',                'RegistrationLogin@index');
Route::post   ('/registration_login',                'RegistrationLogin@login');


Route::get('laravel-send-email', 'EmailController@sendEMail');