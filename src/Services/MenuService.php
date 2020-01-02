<?php

namespace Jybtx\Backstaged\Services;

use Facades\ {
    Jybtx\Backstaged\Repositories\Eloquent\RoleRepository,
    Jybtx\Backstaged\Repositories\Eloquent\MenuRepository,
    Jybtx\Backstaged\Repositories\Eloquent\PermissionRepository
};

class MenuService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return self::getCagetgoryMenu();
    }
    /**
     * 获取分类栏目
     * @author jybtx
     * @date   2019-11-30
     * @return [type]     [description]
     */
    private function getCagetgoryMenu()
    {
        $data =  MenuRepository::all();
        return self::getCategoryChild($data);
    }
    /**
     * [getCategoryChild description]
     * @author jybtx
     * @date   2019-11-30
     * @param  [type]     $categories [description]
     * @param  integer    $pid        [description]
     * @return [type]                 [description]
     */
    public function getCategoryChild( $categories , $pid = 0 )
    {
        $array = array();
        if( empty( $categories ) ) return '';
        foreach ($categories as $k => $v)
        {
            if( $v['pid'] == $pid )
            {
                $array[$k] = $v;
                $array[$k]['child'] = self::getCategoryChild($categories,$v['id']);
            }
        }
        return $array;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}