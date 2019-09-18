<?php

Auth::routes();

Route::get    ('/admin',                                  'Admin@index')->middleware('auth');
Route::post   ('/admin/add/admin',                        'AdminUsers@store')->middleware('auth');\
Route::post   ('/admin/add/report_to',                    'AdminReportTos@store')->middleware('auth');
Route::get    ('/admin/delete/admin/{conf_num}/{id}',     'Admin@deleteAdmin')->middleware('auth');
Route::get    ('/admin/delete/report_to/{conf_num}/{id}', 'Admin@deleteReportTo')->middleware('auth');
Route::get    ('/admin/reset/admin/{conf_num}/{id}',      'Admin@resetAdmin')->middleware('auth');
Route::post   ('/admin/set',                              'AdminPasswords@update');
Route::get    ('/admin/set/{conf_num}/{id}',              'AdminPasswords@show');






Route::get    ('/forgot',                                 'ForgotConfNum@index');
Route::post   ('/forgot',                                 'ForgotConfNum@CheckEmail');

Route::get    ('/',                                       'Registrations@index');
Route::get    ('/registration',                           'Registrations@index');
Route::post   ('/registration',                           'Registrations@store');
Route::get    ('/registration/{conf_num}/{id}/edit',      'Registrations@show');
Route::put    ('/registration/{conf_num}/{id}',           'Registrations@update');
Route::delete ('/registration/{conf_num}/{id}/delete',    'Registrations@destroy');

Route::get    ('/registration_login',                     'RegistrationLogin@index');
Route::post   ('/registration_login',                     'RegistrationLogin@login');
