<?php

namespace App\Http\Requests\Gateway;

use App\Models\Gateway;
use Illuminate\Foundation\Http\FormRequest;

class CreateGatewayRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            Gateway::NAME => ['required', 'string'],
            Gateway::LOGO => ['nullable', 'image', 'mimes:jpeg,png', 'max:100'],
        ];
    }
}
