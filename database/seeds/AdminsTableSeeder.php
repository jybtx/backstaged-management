<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Jybtx\Backstaged\Models\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username'       => 'admin',
            'name'           => '吾（蔣）嶽髑樽',
            'email'          => 'admin@admin.com',
            'telphone'       => '13145203344',
            'role_id'        => 1,
            'password'       => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);
        Admin::create([
            'username'       => 'jybtx',
            'name'           => '用户',
            'email'          => 'jybtx@jybtx.com',
            'telphone'       => '13145203345',
            'role_id'        => 2,
            'password'       => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);
    }
}
