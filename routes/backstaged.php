<?php

Route::group(['prefix'=> config('backstaged.route.prefix'),'middleware'=> config('backstaged.route.middleware') ],function($route){
	$route->get('login','LoginController@showLoginForm');
});