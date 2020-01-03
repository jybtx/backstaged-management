<?php

namespace Jybtx\Backstaged\Console;

use Illuminate\Console\Command;
use Jybtx\Backstaged\Console\Seeds\AdminsTableSeeder;
use Jybtx\Backstaged\Console\Seeds\MenusTableSeeder;
use Jybtx\Backstaged\Console\Seeds\RoleTableSeeder;

class ExportSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jybtx:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install this background extension and migrate and populate background basic data';

    protected $seeds = [
        AdminsTableSeeder::class,
        MenusTableSeeder::class,
        RoleTableSeeder::class
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        foreach ( $this->seeds as $seed ) {
            $this->call($seed);
        }
        $this->exportBackend();
        $this->call('vendor:publish',[
            "--provider" => "Jybtx\Backstaged\Providers\BackstagedServiceProvider"
        ]);
        $this->call('vendor:publish',[
            "--provider" => "Mews\Captcha\CaptchaServiceProvider"
        ]);
        $this->info("The background management extension installation was successful!");
    }
     /**
     * Export the authentication backend.
     *
     * @return void
     */
    protected function exportBackend()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../../routes/route.stub'),
            FILE_APPEND
        );
    }
}