<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatFormValidation extends FormRequest
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
            //all the category form validation rules are present here
            'category_name' => 'required|min:2',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'category_name.required' => 'category name is required',
            'category_name.min' => 'category name must have minimum 2 characters',
            'user_id.required' => 'user id is required' 
        ];
    }
}
