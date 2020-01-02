<?php

namespace Jybtx\Backstaged\Services;

use Facades\ {
    Jybtx\Backstaged\Repositories\Eloquent\AdminRepository
};


class ManagerService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdminRepository::with('role:id,name')->orderBy('id','desc')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($attributes)
    {
        $result = AdminRepository::create($attributes);
        if ( $result ) {
            flash('管理员添加成功！')->success();
            return redirect()->route('manager.index');
        } else {
            flash('管理员添加失败！')->error();
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
        return AdminRepository::find($id);
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
        $result = AdminRepository::update($attributes,$id);
        if ( $result ) {
            flash('管理员修改成功！')->success();
            return redirect()->route('manager.index');
        } else {
            flash('管理员修改失败！')->error();
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
        $result = self::show($id);
        if ( $result->role_id == 1 ) return response()->json(['status'=>0,'msg'=>'超级管理员严禁删除！']);
        self::deleteImages($id);
        if ( $result->delete() ) {
            return response()->json(['status'=>1,'msg'=>'此管理员删除成功！']);
        } else {
            return response()->json(['status'=>0,'msg'=>'此管理员删除失败！']);
        }
    }
    /**
     * 更新图片
     * @author jybtx
     * @date   2019-12-04
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function deleteImages($id)
    {
        $data = self::show($id);
        if( !empty($data->avatar) && file_exists( public_path() . '/' . $data->avatar ) )
        {
            @unlink( public_path() . '/' . $data->avatar );
        }
    }
}