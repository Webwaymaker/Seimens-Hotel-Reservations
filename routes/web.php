<?php

//------------------------------------------------------------------------------
// Project Routes
//------------------------------------------------------------------------------

Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::get    ('/admin',                                  'Admin@index');
	Route::post   ('/admin/display/registrations',            'Admin@index');
	Route::get    ('/admin/display/{display}',                'Admin@index');
	Route::post   ('/admin/add/admin',                        'AdminUsers@store');
	Route::post   ('/admin/add/report_to',                    'AdminReportTos@store');
	Route::get    ('/admin/{token}/{id}/delete',              'AdminUsers@destroy');
	Route::post   ('/admin/blackout',                         'AdminBlackouts@store');
	Route::get    ('/admin/blackout/{token}/{id}/delete',     'AdminBlackouts@destroy');
	Route::get    ('/admin/report_to/{token}/{id}/delete',    'AdminReportTos@destroy');
	Route::get    ('/admin/password/{token}/{id}/reset',      'AdminUsers@update');
});

Route::post   ('/admin/reset',                               'AdminPasswords@update');
Route::get    ('/admin/reset/{time}/{token}/{id}',           'AdminPasswords@show'); 
Route::post   ('/admin/set',                                 'AdminPasswords@update');
Route::get    ('/admin/set/{token}/{id}',                    'AdminPasswords@index');

Route::get    ('/forgot',                                    'ForgotConfNum@index');
Route::post   ('/forgot',                                    'ForgotConfNum@CheckEmail');

Route::get    ('/',                                          'Registrations@index');
Route::get    ('/registration',                              'Registrations@index');
Route::post   ('/registration',                              'Registrations@store');
Route::get    ('/registration/{conf_num}/{id}/edit',         'Registrations@show');
Route::get    ('/registration/{conf_num}/{id}/edit/admin',   'Registrations@showAdmin')->middleware(['auth']);
Route::put    ('/registration/{conf_num}/{id}',              'Registrations@update');
Route::delete ('/registration/{conf_num}/{id}/delete',       'Registrations@destroy');

Route::get    ('/registration_login',                        'RegistrationLogin@index');
Route::post   ('/registration_login',                        'RegistrationLogin@login');


//------------------------------------------------------------------------------
// Management Routes
//------------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
	Route::get    ('/managment/clear_cache',                  'Managment\CliCacheController@clearCache');
	Route::get    ('/managment/clear_cache_all',              'Managment\CliCacheController@ClearCacheAll');
	Route::get    ('/managment/clear_config_cache',           'Managment\CliCacheController@clearConfigCache');
	Route::get    ('/managment/run_report',                   'Managment\RunNightlyReport@run');
});


//------------------------------------------------------------------------------
// Clouser Routes
//------------------------------------------------------------------------------

	// For some reason the laravel scheduler is not working in production.  In
	// order to have the nightly report created I had to create a Cron Job 
	// on BlueHost to run this route every day at 5:00 AM Server Time / 
	// 1 AM CDT.  I hate to have to do it this way but it is the only solution
	// I can find (rnr = Run Nightly Report)
    
	Route::get('/rnr', function () {
		Artisan::call('command:RunRegistrationReport');
	});

