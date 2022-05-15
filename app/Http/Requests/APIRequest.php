<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\HTTP\Exceptions\HttpResponseException;

class APIRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * Override FormRequest class - failedValidation function
     * to response JSON with 400 rather then doing redirection
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * @example Illuminate\Foundation\Http\FormRequest failedValidation()
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['errors' => $validator->errors()], 400));
    }
}
