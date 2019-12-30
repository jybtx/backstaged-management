<?php
//  DIRECTORY_SEPARATOR

$prefix = config('backstaged.route.prefix');

Route::group(['prefix'=> config('backstaged.route.prefix')],function($route){
	$route->get('login','AuthenticateController@showLoginForm');
	$route->post('login','AuthenticateController@login')->name(config('backstaged.route.prefix').'.login');
});

Route::group(['prefix'=> config('backstaged.route.prefix'),'middleware'=> config('backstaged.route.middleware') ],function($route){
	$route->get('/','HomeController@index');
	$route->get('logout','AuthenticateController@logout')->name( config('backstaged.route.prefix').'.logout' );
});

