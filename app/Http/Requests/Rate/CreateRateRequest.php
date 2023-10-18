<?php

namespace App\Http\Requests\Rate;

use App\Models\Network;
use App\Models\Rate;
use App\Rules\CurrencyCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRateRequest extends FormRequest
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
            Rate::NETWORK_ID => ['required', Rule::exists(Network::TABLE, Network::ID)],
            Rate::BASE => ['required', new CurrencyCodeRule()],
            Rate::CURRENCY => ['required', new CurrencyCodeRule()],
            Rate::SELL => ['required', 'decimal:2,18'],
            Rate::BUY => ['required', 'decimal:2,18'],
            Rate::DESCRIPTION => ['nullable', 'string'],
        ];
    }
}
