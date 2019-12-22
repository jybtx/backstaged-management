<?php

Route::group(['prefix'=> config('backstaged.route.prefix') ],function($route){
	$route->get('login','LoginController@showLoginForm');
});