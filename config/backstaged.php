<?php

return [

 	/*
    |--------------------------------------------------------------------------
    | background management system route setting
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),

        'namespace' => 'Jybtx\\Backstaged\\Http\\Controllers',

        'middleware' => ['admin'],
    ],
    /*
    |--------------------------------------------------------------------------
    | background management system auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
   'auth' => [
        'guard' => 'admin',
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admins',
            ],
        ],
        'providers' => [
            'admins' => [
                'driver' => 'eloquent',
                'model' => Jybtx\Backstaged\Models\Admin::class,
            ],
        ],
   ],
    /*
    |--------------------------------------------------------------------------
    | Previous background path
    |--------------------------------------------------------------------------
    |
    |
    */
     
    'before_path' => env('BEFORE_ADMIN', ''),
    /*
    |--------------------------------------------------------------------------
    | Whether to change the current background path
    |--------------------------------------------------------------------------
    |
    |
     */
    'path_chenge' => env('PATH_CHANGE',false),
   

    // 自定义用户名
    'username' => 'username',

];