<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $request = Request::all();

        if (isset($request['id'])) {
            return [
                'email'      =>  'required|email|unique:users,email,'.$request['id'],
            ];
        } else {
            return [
                'email'      =>  'required|email|unique:users,email'
            ];
        }
        
    }
    public function messages()
    {
        return [
            'email.required' => 'El email es requerido',
        ];
    }
}
