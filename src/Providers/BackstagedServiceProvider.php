<?php

namespace Jybtx\Backstaged\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Jybtx\Backstaged\Console\ExportSeedCommand;
use Jybtx\Backstaged\Http\ViewComposers\menuSideBarViewComposer;
class BackstagedServiceProvider extends ServiceProvider
{
    protected $routeMiddleware = [
        'admin' => \Jybtx\Backstaged\Http\Middleware\AuthAdminMiddleware::class
    ];
    protected $middlewareGroups = [];
    protected $commands = [
        ExportSeedCommand::class
    ];
    /**
     * [registerRouteMiddleware description]
     * @author jybtx
     * @date   2019-12-28
     * @return [type]     [description]
     */
    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }
        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }
    /**
     * Merge configuration.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/backstaged.php', 'backstaged'
        );
    }
    /**
     * Configure package paths.
     * @author jybtx
     * @date   2019-12-24
     * @return [type]     [description]
     */
    private function configurePaths()
    {
        if ( $this->app->runningInConsole() ) {
            $this->publishes([
                __DIR__."/../../config/backstaged.php" => config_path('backstaged.php'),
            ]);
            $this->publishes([
                __DIR__ . "/../../resources/views" => base_path('resources/views/')
            ]);
            $this->publishes([
                __DIR__ . "/../../resources/assets" => public_path('vendor/')
            ]);
            $this->publishes([
                __DIR__ . "/../../database/migrations" => database_path('migrations')
            ]);
            $this->publishes([
                __DIR__ . "/../../resources/lang" => base_path('resources/lang/')
            ]);
        }
    }
    /**
     * [viewsPaths description]
     * @author jybtx
     * @date   2019-12-27
     * @return [type]     [description]
     */
    private function viewsPaths()
    {
        $this->loadViewsFrom(
            __DIR__ . "/../../resources/views/admin", "jybtx"
        );
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        // $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'courier');
        
    }
    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('backstaged.auth', []), 'auth.'));
    }
    /**
     * [使用基于类的composers...     视图共享]
     * @author jybtx
     * @date   2019-12-31
     * @return [type]     [description]
     */
    protected function viewComposer(){
        view()->composer('layouts.sidebar',menuSideBarViewComposer::class);
    }
    
    /**
     * 在容器中注册绑定。
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->loadAdminAuthConfig();
        $this->registerRouteMiddleware();
        $this->commands($this->commands);
    }

    /**
     * 执行服务的注册后启动。
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePaths();
        $this->viewsPaths();
        $this->viewComposer();
    }
    
}