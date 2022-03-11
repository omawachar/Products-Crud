<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProFormValidation extends StoreProFormValidation
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
            'subcategory' => 'required'
        ];
        return $rules = array_merge($existing_rules, $new_rules);
    }

    public function messages()
    {
        $existing_msgs = parent::messages();

        $new_msgs = [
            'subcategory.required' => 'subcategory required'
        ];
        return   array_merge($existing_msgs, $new_msgs);
    }
}
