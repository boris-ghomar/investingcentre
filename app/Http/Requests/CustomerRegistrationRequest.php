<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $u
 * @property string $d
 */
class CustomerRegistrationRequest extends FormRequest
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
     * @return mixed
     */
    public function rules(): array
    {
        return [
            "u" => "required|string|regex:/^[a-zA-Z0-9\/\r\n+]*={0,2}$/|max:350",
            "d" => "required|string|regex:/^[a-zA-Z0-9\/\r\n+]*={0,2}$/|max:350",
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        abort(404);
    }
}
