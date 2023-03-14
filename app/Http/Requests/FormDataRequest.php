<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
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
    public function rules(){
        return [
            'name_en' => 'required',
            'name_bn' => 'required',
        ];
    }
    public function messages(){
        return [
            'name_en.required' => 'Name English is must.',
            'name_bn.required' => 'Name Bangla is must.',
        ];
    }
}
