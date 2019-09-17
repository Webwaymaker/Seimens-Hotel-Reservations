<?php

Auth::routes();

Route::get    ('/admin',                               'Admin@index');
Route::post   ('/admin/add/admin',                     'Admin@addAdmin');
Route::post   ('/admin/add/report_to',                 'Admin@addReportTo');

Route::get    ('/forgot',                              'ForgotConfNum@index');
Route::post   ('/forgot',                              'ForgotConfNum@CheckEmail');

Route::get    ('/',                                    'Registrations@index');
Route::get    ('/registration',                        'Registrations@index');
Route::post   ('/registration',                        'Registrations@store');
Route::get    ('/registration/{conf_num}/{id}/edit',   'Registrations@show');
Route::put    ('/registration/{conf_num}/{id}',        'Registrations@update');
Route::delete ('/registration/{conf_num}/{id}/delete', 'Registrations@destroy');

Route::get    ('/registration_login',                  'RegistrationLogin@index');
Route::post   ('/registration_login',                  'RegistrationLogin@login');
