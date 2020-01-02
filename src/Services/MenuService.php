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
        return MenuRepository::findWhere(['pid'=>0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($attributes)
    {
        $data = [
            'pid'         => $attributes['menu_pid'],
            'name'        => $attributes['menu_name'],
            'icon'        => $attributes['menu_icon'],
            'controller'  => $attributes['menu_controller'],
            'url'         => $attributes['menu_url'],
            'active'      => $attributes['menu_active'],
            'description' => $attributes['menu_description']?:'',
        ];
        if( isset( $attributes['attr_name'] ) )
        {
            $array = [];
            $key = $attributes['attr_name'];
            $value = $attributes['attr_value'];
            for ($i=0; $i < count($key) ; $i++) {
                $array[] = [
                    'name'  => $key[$i],
                    'value' => $value[$i]
                ];
            }
            $data['active_model'] = json_encode($array);
        }
        else
        {
            $data['active_model'] = '';
        }
        $bool = MenuRepository::create($data);
        if( $bool != FALSE )
        {
            flash('菜单添加成功！','success');
            return redirect()->route('menu.index');
        }
        else
        {
            flash('菜单添加失败！','error');
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
        return MenuRepository::find($id);
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
        $data = [
            'pid'         => $attributes['menu_pid'],
            'name'        => $attributes['menu_name'],
            'icon'        => $attributes['menu_icon'],
            'controller'  => $attributes['menu_controller'],
            'url'         => $attributes['menu_url'],
            'active'      => $attributes['menu_active'],
            'description' => $attributes['menu_description']?:'',
        ];

        if( isset( $attributes['attr_name'] ) )
        {
            $array = [];
            $key = $attributes['attr_name'];
            $value = $attributes['attr_value'];
            for ($i=0; $i < count($key) ; $i++) {
                $array[] = [
                    'name'  => $key[$i],
                    'value' => $value[$i]
                ];
            }
            $data['active_model'] = json_encode($array);
        }
        else
        {
            $data['active_model'] = '';
        }
        $bool = MenuRepository::update($data,$id);
        if( $bool != FALSE )
        {
            flash('菜单修改成功！','success');
            return redirect()->route('menu.index');
        }
        else
        {
            flash('菜单修改失败！','error');
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
        @PermissionRepository::deleteWhere(['menu_id'=>$id]);
        $result = self::show($id);
        @$result->where(['pid'=>$id])->update(['pid'=>0]);
        if ( $result->delete() ) {
            return response()->json(['status'=>1,'msg'=>'此菜单删除成功！']);
        } else {
            return response()->json(['status'=>0,'msg'=>'此菜单删除失败！']);
        }
    }
}