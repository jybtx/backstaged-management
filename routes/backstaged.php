<?php
//  DIRECTORY_SEPARATOR

Route::group(['prefix'=> prefixPath()],function($route){
	$route->get('login','AuthenticateController@showLoginForm');
	$route->post('login','AuthenticateController@login')->name(prefixPath().'.login');
});

Route::group(['prefix'=> prefixPath(),'middleware'=> config('backstaged.route.middleware') ],function($route){
	
	$route->post('/clear','HomeController@clearAllCache')->name(prefixPath() .'.clear');
	$route->post('logout','AuthenticateController@logout')->name( prefixPath() .'.logout' );

	$route->resource('manager','ManagerController');
	$route->resource('role','RoleController');
	$route->resource('menu','MenuController');
});

