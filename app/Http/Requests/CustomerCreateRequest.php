<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "u" => "required|string|regex:/^[a-zA-Z0-9\/\r\n+]*={0,2}$/|max:350",
            "d" => "required|string|regex:/^[a-zA-Z0-9\/\r\n+]*={0,2}$/|max:350",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "phone" => "required|string",
            "password" => "required|string|confirmed",
        ];
    }
}
