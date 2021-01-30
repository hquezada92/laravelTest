<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'sku' => 'required|unique:products|alpha_num',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'quantity' => 'required|integer',
            'description' => 'string',
            'imageUrl' => 'string',
            'price' => 'required|numeric'
        ];
    }
}
