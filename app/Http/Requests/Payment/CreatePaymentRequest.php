<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'amount'=>'required|string',
//            'merchant_id' => 'required|exists:merchants,id',
            'currency'=>'nullable|numeric',
            'factor'=>'nullable|string',
            'description'=>'nullable|string',
            'webhook'=>'nullable|url',
            'callback'=>'nullable|url',
        ];
    }
}
