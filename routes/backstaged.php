<?php

Route::group(['prefix'=> config('backstaged.route.prefix')/*,'middleware'=> config('backstaged.route.middleware')*/ ],function($route){
	$route->get('login','LoginController@showLoginForm');
	$route->post('login','LoginController@login')->name(config('backstaged.route.prefix').'.login');
});

