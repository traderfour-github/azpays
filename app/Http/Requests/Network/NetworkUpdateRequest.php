<?php

namespace App\Http\Requests\Network;

use App\Models\Network;
use App\Rules\CountryCodeRule;
use App\Rules\MobileRegexRule;
use Illuminate\Foundation\Http\FormRequest;

class NetworkUpdateRequest extends FormRequest
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
            Network::NAME => ['required', 'string'],
            Network::FEE => ['required', 'decimal:2'],
            Network::SUPPORT_PORTAL => ['nullable', 'url'],
            Network::SUPPORT_EMAIL => ['nullable', 'email'],
            Network::SUPPORT_PHONE => ['nullable', new MobileRegexRule()],
            Network::PROCESSING_TIME => ['nullable', 'integer'],
            Network::CONFIRM_TIME => ['nullable', 'integer'],
            Network::PAYOUT_TIME => ['nullable', 'integer'],
            Network::COUNTRIES => ['nullable', 'array'],
            Network::COUNTRIES.'.*' => [new CountryCodeRule()],
            Network::PROCESSORS => ['nullable', 'string'],
            Network::LOGO => ['nullable', 'image', 'mimes:jpeg,png', 'max:100'],
        ];
    }
}
