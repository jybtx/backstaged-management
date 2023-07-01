<?php
//  DIRECTORY_SEPARATOR

Route::group(['prefix'=> config('backstaged.route.prefix')],function($route){
	$route->get('login','AuthenticateController@showLoginForm');
	$route->post('login','AuthenticateController@login')->name(config('backstaged.route.prefix').'.login');
});

Route::group(['prefix'=> config('backstaged.route.prefix'),'middleware'=> config('backstaged.route.middleware') ],function($route){

	$route->post('/clear','HomeController@clearAllCache')->name(prefixPath() .'.clear');
	$route->post('logout','AuthenticateController@logout')->name( prefixPath() .'.logout' );

	$route->resource('manager','ManagerController');
	$route->resource('role','RoleController');
	$route->resource('menu','MenuController');
});

