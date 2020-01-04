<?php

namespace Jybtx\Backstaged\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Jybtx\Backstaged\Http\Controllers\Controller;
class HomeController extends Controller
{
	
	public function index()
	{
		return view('jybtx::index');
	}
	/**
	 * 清除缓存
	 * @author jybtx
	 * @date   2020-01-04
	 * @return [type]     [description]
	 */
	public function clearAllCache()
	{
		Artisan::call('view:clear');
    	cache()->flush();
    	return response()->json(['status'=>1,'msg'=>'缓存清除成功！']);
	}
}