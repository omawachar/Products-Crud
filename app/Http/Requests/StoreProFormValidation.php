<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProFormValidation extends FormRequest
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
        return $rules = [
            //put all the form validations here
            'name' => 'required|min:2',
            'category_id' => 'required',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'producut name is required',
            'name.min' => 'name must have minimum 2 characters ',
            'category.required' => 'Category is required',
            

        ];
    }
}
