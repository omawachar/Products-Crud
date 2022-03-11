<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubcatRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required|min:2',
            'user_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'please select a category',
            'name.required' => 'subcategory name iss required',
            'name.min' => 'name must be atleast 2 characters',
            'user_id' => 'user id is required'
        ];
    }
}
