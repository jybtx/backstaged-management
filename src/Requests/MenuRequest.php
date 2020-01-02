<?php

namespace Jybtx\Backstaged\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if( $request->isMethod('POST') ) {
            return [
                'menu_name'       => 'required|string|min:2|unique:menus,name',
                'menu_icon'       => 'required|string',
                'menu_controller' => 'required|string',
                'menu_url'        => 'required|string',
                'menu_active'     => 'required|string',
            ];
        } else {
            return [
                'menu_name'       => 'required|string',
                'menu_icon'       => 'required|string',
                'menu_controller' => 'required|string',
                'menu_url'        => 'required|string',
                'menu_active'     => 'required|string',
            ];
        }
    }
    public function attributes()
    {
        return [
            'menu_name'       => '菜单名称',
            'menu_icon'       => '菜单图标',
            'menu_controller' => '控制器名称',
            'menu_url'        => '菜单链接地址',
            'menu_active'     => '菜单高亮地址',
        ];
    }
}
