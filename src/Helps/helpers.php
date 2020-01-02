<?php

use Jybtx\Backstaged\Models\Menu;
use Jybtx\Backstaged\Models\Permission;

if ( ! function_exists('prefixPath') ) {
	/**
	 * [prefixPath description]
	 * @author jybtx
	 * @date   2019-12-30
	 * @return [type]     [description]
	 */
	function prefixPath()
	{
		return config('backstaged.route.prefix');
	}
}
if ( ! function_exists('administrator') ) {
	/**
	 * [administrator description]
	 * @author jybtx
	 * @date   2020-01-02
	 * @return [type]     [description]
	 */
	function administrator(){
		return auth(config('backstaged.auth.guard'))->user();
	}
}

if ( !function_exists('btnprimission') ) {
    /**
     * 用户按钮权限
     * @author jybtx
     * @date   2019-12-13
     * @param  [type]     $method [description]
     * @return [type]             [description]
     */
    function btnprimission($method){
        // 获取当前url
        $currentUrl = parse_url(url()->current());
        $queryParts = explode('/', $currentUrl['path']);
        $path = $queryParts[1] . '/' . $queryParts[2];
        // 查询当前url和栏目里面的url是否相同
        $url = Menu::where(['url'=>$path])->first();
        if( empty($url) ) return false;
        // 从权限表里面查询
        $permission = Permission::where(['menu_id'=>$url->id,'role_id'=>auth('admin')->user()->role_id])->first();
        if( empty($permission) ) return false;
        if( !in_array( $method, json_decode($permission->authority) ) ) return false;
        return true;
    }
}