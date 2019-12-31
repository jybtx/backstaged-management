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
    protected $signature = 'admin:export-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export Seed Command';

    protected  $seeds = [
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
        foreach ( $this->seeds as $seed )
        {
            $this->call($seed);
        }
        $this->info("Seed data is successfully populated!");
    }
}