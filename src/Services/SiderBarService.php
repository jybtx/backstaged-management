<?php

namespace Jybtx\Backstaged\Services;

use Facades\ {
    Jybtx\Backstaged\Repositories\Eloquent\PermissionRepository,
    Jybtx\Backstaged\Repositories\Eloquent\MenuRepository
};

class SiderBarService
{
    /**
     * 根据角色获取菜单数据
     * @return [array] [description]
     * @author 蒋岳 <[email address]>
     */
    public function getPermission()
    {
        $getMenuId = PermissionRepository::findByField(['role_id'=>auth('admin')->user()->role_id])->pluck('menu_id')->toArray();
        if ( $getMenuId ) {
//            $MenuId = array_column($getMenuId,'menu_id');
            $menus = MenuRepository::orderBy('sort','asc')->findWhereIn('id',$getMenuId)->toArray();
            if( $menus ){
                $menuList = $this->sortMenu( $menus );
                foreach ($menuList as $k => &$v) {
                    if ($v['child']) {
                        $sort = array_column($v['child'], 'sort');
                        array_multisort($sort,SORT_DESC,$v['child']);
                    }
                }
            }
        } else {
            abort(404);
        }
        return $menuList;
    }

    /**
     * 递归菜单数据
     * @param  [array]  $menus [description]
     * @param  integer $pid   [description]
     * @return [array]         [description]
     * @author 蒋岳 <[email address]>
     */
    public function sortMenu( $menus, $pid=0 )
    {
        $arr = array();
        if( empty( $menus ) ) return '';
        foreach ($menus as $key => $v) {
            if( $v['pid'] == $pid ){
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortMenu($menus , $v['id'] );
            }
        }
        return $arr;
    }
}