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
            'menu_name'       => trans("Menu name"),
            'menu_icon'       => trans("Menu icon"),
            'menu_controller' => trans("Controller name"),
            'menu_url'        => trans("Menu link address"),
            'menu_active'     => trans("Menu highlight address"),
        ];
    }
}
