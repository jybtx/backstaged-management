<?php
namespace Jybtx\Backstaged\Http\Middleware;

use Closure;
use Jybtx\Backstaged\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Jybtx\Backstaged\Models\Permission;

class AuthAdminMiddleware
{
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next, $guard = null)
	{

          if ( !auth()->guard(config('backstaged.auth.guard'))->check() ) {
               if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
               } else {
                    return redirect()->guest(config('backstaged.route.prefix').DIRECTORY_SEPARATOR.'login');
               }
          }
          self::ChangeBackgroundRouting();
          // 权限
          $name = array();
          if(Route::currentRouteName() == ''){
               $c = Route::currentRouteAction();
               list($class, $method) = explode('@', $c);
               $e = explode('\\',substr($class,0,-10));
               $name = [
                     'controller' =>end($e),
                     'method'     =>$method
               ];
          }else{
               $c = Route::currentRouteName();
               $e = explode('.',$c);
               $name = [
                     'controller' =>$e[0],
                     'method'     =>$e[1]
               ];
          }
          // 获取管理员的id
          $adminId = auth(config('backstaged.auth.guard'))->user()->id;
          // 获取管理员role的id
          $adminRoleId = auth(config('backstaged.auth.guard'))->user()->role_id;

          // 获取当前url
          $currentUrl = parse_url(url()->current());
          $route = self::convertUrlQuery($currentUrl['path']);

          // 当前页面是登录后的首页和退出页面也是直接执行下一步
          if( $route == prefixPath() .'/index' ||  $route == prefixPath() .'/logout' || $route == prefixPath() .'/clear' ||  $route == prefixPath() .'/logs' ) return $next($request);

          // 查询当前url和栏目里面的url是否相同
          $url = Menu::where(['url'=>$route])->first();

          if( empty($url) ) abort(404);

          // 从权限表里面查询
          $permission = Permission::where(['menu_id'=>$url->id,'role_id'=>$adminRoleId])->first();

          if( empty($permission) ) abort(401);

          if( !in_array( $name['method'], json_decode($permission->authority) ) ) abort(401);
          
          return $next($request);
	}

    public function convertUrlQuery($query)
    {
        $queryParts = explode('/', $query);
        $path = $queryParts[1] . '/' . $queryParts[2];
        return $path;
    }
    /**
     * 修改后台URL地址
     * @author jybtx
     * @date   2020-01-04
     */
    public function ChangeBackgroundRouting()
    {
        if ( config('backstaged.path_chenge') ) {
            if ( empty(config('backstaged.before_path')) ) return false;
            if ( hash_equals(config('backstaged.before_path'),config("backstaged.route.prefix")) ) return false;
            $permissions = Menu::get()->toArray();            
            foreach ($permissions as $key => $permission) {
                $method = array_filter(explode('/', $permission['url']));
                $str = str_replace(config('backstaged.before_path'),config("backstaged.route.prefix"),$method);
                $path = implode('/',$str);
                
                $actives = array_filter(explode('/', $permission['active']));
                $strs = str_replace(config('backstaged.before_path'),config("backstaged.route.prefix"),$actives);
                $paths = implode('/',$strs);
                Menu::where(['id'=>$permission['id']])->update(['url'=>$path,'active'=>$paths]);                
            }
        }
    }
}