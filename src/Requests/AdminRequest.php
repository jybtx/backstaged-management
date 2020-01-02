<?php

namespace Jybtx\Backstaged\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                'username' => 'required|string|min:2|unique:admins,username',
                'password' => 'required|string|min:6',
            ];
        } else {
            return [
                'name'     => 'required|string',
                'email'    => 'required|string|email',
                'telphone' => 'required|string',
                'avatar'   => 'image',
            ];
        }
    }
}
