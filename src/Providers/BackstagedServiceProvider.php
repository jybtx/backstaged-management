<?php

namespace Jybtx\Backstaged\Providers;

use Illuminate\Support\ServiceProvider;

class BackstagedServiceProvider extends ServiceProvider
{

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
        $this->publishes([
            __DIR__."/../../config/backstaged.php" => config_path('backstaged.php'),
        ]);
        $this->publishes([
            __DIR__ . "/../../resources/views" => base_path('resources/views/')
        ]);
        $this->publishes([
            __DIR__ . "/../../resources/assets" => public_path('vendor/')
        ]);
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
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePaths();
        $this->viewsPaths();
    }
}