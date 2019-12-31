<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = '[{"name":"\u5217\u8868","value":"index"},{"name":"\u6dfb\u52a0\u9875\u9762","value":"create"},{"name":"\u6dfb\u52a0","value":"store"},{"name":"\u4fee\u6539\u9875\u9762","value":"edit"},{"name":"\u4fee\u6539","value":"update"},{"name":"\u5220\u9664","value":"destroy"},{"name":"\u67e5\u770b","value":"show"}]';

        Menu::create([
			'pid'          => 0,
			'name'         => '控制台',
			'icon'         => 'mdi-desktop-mac',
			'url'          => 'backstaged/index',
			'active'       => 'backstaged/index*',
			'description'  => '控制台',
			'controller'   => 'init',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 0,
			'name'         => '常用操作',
			'icon'         => 'mdi-clipboard',
			'url'          => 'init',
			'active'       => 'backstaged/article*,backstaged/category*,backstaged/picture*,backstaged/link*',
			'description'  => '常用操作',
			'controller'   => 'init',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 0,
			'name'         => '网站设置',
			'icon'         => 'mdi-windows',
			'url'          => 'init',
			'active'       => 'backstaged/config*',
			'description'  => '网站设置',
			'controller'   => 'init',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 0,
			'name'         => '后台管理',
			'icon'         => 'mdi-laptop-mac',
			'url'          => 'init',
			'active'       => 'backstaged/manager*,backstaged/permission*,backstaged/role*,backstaged/menu*',
			'description'  => '后台管理',
			'controller'   => 'init',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '文章管理',
			'icon'         => 'fa-file-text',
			'url'          => 'backstaged/article',
			'active'       => 'backstaged/article*',
			'description'  => '文章管理',
			'controller'   => 'article',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '分类管理',
			'icon'         => 'fa-th-large',
			'url'          => 'backstaged/category',
			'active'       => 'backstaged/category*',
			'description'  => '分类管理',
			'controller'   => 'category',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 3,
			'name'         => '基本设置',
			'icon'         => 'fa-wrench',
			'url'          => 'backstaged/config',
			'active'       => 'backstaged/config*',
			'description'  => '基本设置',
			'controller'   => 'config',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '图片管理',
			'icon'         => 'fa-image',
			'url'          => 'backstaged/picture',
			'active'       => 'backstaged/picture*',
			'description'  => '图片管理',
			'controller'   => 'picture',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 4,
			'name'         => '管理员管理',
			'icon'         => 'fa-user',
			'url'          => 'backstaged/manager',
			'active'       => 'backstaged/manager*',
			'description'  => '管理员管理',
			'controller'   => 'manager',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '友情链接',
			'icon'         => 'fa-link',
			'url'          => 'backstaged/link',
			'active'       => 'backstaged/link*',
			'description'  => '友情链接',
			'controller'   => 'link',
			'active_model' => $dataArray,
        ]);
//        Menu::create([
//			'pid'          => 4,
//			'name'         => '权限管理',
//			'icon'         => 'init',
//			'url'          => 'backstaged/permission',
//			'active'       => 'backstaged/permission*',
//			'description'  => '权限管理',
//			'controller'   => 'permission',
//			'active_model' => $dataArray,
//        ]);
        Menu::create([
			'pid'          => 4,
			'name'         => '角色管理',
			'icon'         => 'init',
			'url'          => 'backstaged/role',
			'active'       => 'backstaged/role*',
			'description'  => '角色管理',
			'controller'   => 'role',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 4,
			'name'         => '菜单管理',
			'icon'         => 'init',
			'url'          => 'backstaged/menu',
			'active'       => 'backstaged/menu*',
			'description'  => '菜单管理',
			'controller'   => 'menu',
			'active_model' => $dataArray,
        ]);
    }
}
