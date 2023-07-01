<?php
namespace Jybtx\Backstaged\Console\Seeds;

use Illuminate\Database\Seeder;
use Jybtx\Backstaged\Models\Menu;

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
			'url'          => config('backstaged.route.prefix').'/index',
			'active'       => config('backstaged.route.prefix').'/index*',
			'description'  => '控制台',
			'sort'         => 0,
			'controller'   => 'init',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 0,
			'name'         => '后台管理',
			'icon'         => 'mdi-laptop-mac',
			'url'          => 'init',
			'active'       => config('backstaged.route.prefix').'/manager*,'.config('backstaged.route.prefix').'/permission*,'.config('backstaged.route.prefix').'/role*,'.config('backstaged.route.prefix').'/menu*',
			'description'  => '后台管理',
			'controller'   => 'init',
			'sort'         => '9999',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '管理员管理',
			'icon'         => 'fa-user',
			'url'          => config('backstaged.route.prefix').'/manager',
			'active'       => config('backstaged.route.prefix').'/manager*',
			'description'  => '管理员管理',
			'controller'   => 'manager',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '角色管理',
			'icon'         => 'init',
			'url'          => config('backstaged.route.prefix').'/role',
			'active'       => config('backstaged.route.prefix').'/role*',
			'description'  => '角色管理',
			'controller'   => 'role',
			'active_model' => $dataArray,
        ]);
        Menu::create([
			'pid'          => 2,
			'name'         => '菜单管理',
			'icon'         => 'init',
			'url'          => config('backstaged.route.prefix').'/menu',
			'active'       => config('backstaged.route.prefix').'/menu*',
			'description'  => '菜单管理',
			'controller'   => 'menu',
			'active_model' => $dataArray,
        ]);
    }
}
