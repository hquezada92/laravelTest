<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required',
            'cellphone' => 'digits_between:7,15',
            'birthdate' => 'date_format:Ymd',
            'name' => 'regex:/^[\pL\s\-]+$/u'
        ];
    }
}
