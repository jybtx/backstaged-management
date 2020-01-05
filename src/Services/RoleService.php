<?php

namespace Jybtx\Backstaged\Services;

use Facades\ {
    Jybtx\Backstaged\Repositories\Eloquent\RoleRepository,
    Jybtx\Backstaged\Repositories\Eloquent\MenuRepository,
    Jybtx\Backstaged\Repositories\Eloquent\PermissionRepository
};

class RoleService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoleRepository::paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return self::getAllMenu();
    }

    /**
     * 获取所有的栏目
     * @return array|string
     */
    public function getAllMenu()
    {
        $data = MenuRepository::orderBy('sort','asc')->all();
        return self::sortMenu($data);
    }

    /**
     * 递归菜单数据
     * @param $menus
     * @param int $pid
     * @return array|string
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($attributes)
    {
        $result = RoleRepository::create($attributes);
        if ( $result ) {
            flash( trans("Role added successfully!") )->success();
            if ( isset($attributes['data']) ) {
                collect($attributes['data'])->map(function ($key,$val) use ($result){
                    PermissionRepository::updateOrCreate(['role_id'=>$result->id,'menu_id'=>$val,'authority'=>json_encode($key)]);
                });
            }
            return redirect()->route('role.index');
        } else {
            flash( trans("Role addition failed!") )->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoleRepository::find($id);
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
    public function update($attributes, $id)
    {
        $result = RoleRepository::update($attributes, $id);
        if ( isset($attributes['data']) ) {
            @PermissionRepository::deleteWhere(['role_id'=>$id]);
            collect($attributes['data'])->map(function ($key,$val) use ($id){
                PermissionRepository::updateOrCreate(['role_id'=>$id,'menu_id'=>$val,'authority'=>json_encode($key)]);
            });
        }
        if ( $result ) {
            flash( trans("Role updated successfully!") )->success();
            return redirect()->route('role.index');
        } else {
            flash( trans("Roles update failed!") )->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = RoleRepository::delete($id);
        if ( $result ) {
            return response()->json(['status'=>1,'msg'=> trans("This role deleted successfully!") ]);
        } else {
            return response()->json(['status'=>0,'msg'=> trans("Role deletion failed!") ]);
        }
    }
}