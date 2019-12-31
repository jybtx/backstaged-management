<?php
//  DIRECTORY_SEPARATOR

Route::group(['prefix'=> prefixPath()],function($route){
	$route->get('login','AuthenticateController@showLoginForm');
	$route->post('login','AuthenticateController@login')->name(prefixPath().'.login');
});

Route::group(['prefix'=> prefixPath(),'middleware'=> config('backstaged.route.middleware') ],function($route){
	$route->get('/index','HomeController@index');
	$route->post('logout','AuthenticateController@logout')->name( prefixPath() .'.logout' );
});

