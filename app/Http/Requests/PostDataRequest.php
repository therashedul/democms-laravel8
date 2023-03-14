<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDataRequest extends FormRequest
{   
    public function authorize(){
        return true;
    }
    
    public function rules() {
        return [
            'name_en' => 'required',
            'content_en' => 'required',    
            'name_bn' => 'required',
            'content_bn' => 'required',
        ];
    }
    public function messages(){
        return [
            'name_en.required' => 'Name English is must.',
            'name_bn.required' => 'Name Bangla is must.',
        ];
    }
}
