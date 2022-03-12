<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
        return [
            'name' => 'required|min:2',
            'email' => 'required |email|unique:users,email',
            'password' => 'required | min:4',
            'role' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'user name is required',
            'name.min' => 'user name must have 2 characters',
            'email.required' => 'email is required',
            'email.email' => 'enter valid email id',
            'email.unique' => 'email already exists',
            'password.required' => 'password required',
            'role.required' => 'role required',
            'password.min' => 'password must have atleast 4 characters',



        ];
    }
}
