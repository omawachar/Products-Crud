<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCatFormValidation extends StoreCatFormValidation
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
        $existing_rules = parent::rules();
        $new_rules = [
            'user_id' => '',
        ];
        return $rules = array_merge($existing_rules, $new_rules);
    }

    public function messages()
    {
        return [
            'category_name.required' => 'name required',
            'category_name.min' => 'category must have atleast two characters',

        ];
    }
}
