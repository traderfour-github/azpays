<?php

namespace App\Http\Requests\Payment;

use App\Rules\MerchantDomainRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'amount'=>'nullable|string',
            'merchant_id' => 'nullable|exists:merchants,id',
            'currency'=>'nullable|numeric',
            'factor'=>'nullable|string',
            'description'=>'nullable|string',
            'webhook'=>'nullable|url',
            'callback'=>'nullable|url',
        ];
    }
}
