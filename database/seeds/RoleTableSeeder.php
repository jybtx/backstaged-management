<?php

use Illuminate\Database\Seeder;
use Jybtx\Backstaged\Models\Role;
use Jybtx\Backstaged\Models\Menu;
use Jybtx\Backstaged\Models\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::insertGetId([
            'name' => '超级管理员',
            'description' => '超级管理员',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userId = Role::insertGetId([
            'name' => '普通用户',
            'description' => '普通用户',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Role::create([
            'name' => '站点管理员',
            'description' => '站点管理员',
        ]);
        Role::create([
            'name' => '发布人员',
            'description' => '发布人员',
        ]);
        Role::create([
            'name' => '运营总监',
            'description' => '运营总监',
        ]);
        Role::create([
            'name' => '编辑',
            'description' => '编辑',
        ]);
        Role::create([
            'name' => '总编',
            'description' => '总编',
        ]);
        $dataArray = ["index","create","store","edit","update","destroy","show"];
        $MenuList = Menu::all();
        foreach ($MenuList as $v) {
            Permission::insert(['role_id'=>$admin,'menu_id'=>$v->id,'authority'=> json_encode($dataArray)  ]);
            Permission::insert(['role_id'=>$userId,'menu_id'=>$v->id,'authority'=> json_encode($dataArray) ]);
        }
    }
}
