<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'email'=>'required|email|max:50|bail',
            'address'=>'required|max:255',
            'password'=>'required|min:10|',
            //'rpass'=>'required|same:pass',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'cannot be empty.',
            'email.required' => 'provide valid email.',
        //     'add.required'=> 'provide your address.'
        //     'phone.required' => 'provide your contact number',
        //     'utype.required'=> 'enter a user type',
        //     'img.required'=> 'please upload a picture',
        //     'pass.required'=> 'minimum 10 characters for password.',
        //     'rpass.required'=>'confirm password',
         ];
    }
}
