<?php

namespace App\Http\Requests\Payment;

use App\Enums\Payment\PaymentMeta;
use Illuminate\Foundation\Http\FormRequest;

class PaymentStartRequest extends FormRequest
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
            PaymentMeta::Password => ['required', 'string'],
        ];
    }
}
