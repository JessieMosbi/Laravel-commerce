<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 現在還沒用到，所以先設為 true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|between:1,10'
        ];
    }

    /**
     * Get the validation rules message when fail.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'quantity.between' => '數量必須在 1~10'
        ];
    }
}
