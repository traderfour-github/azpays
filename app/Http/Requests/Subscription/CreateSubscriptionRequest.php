<?php

namespace App\Http\Requests\Subscription;

use App\Enums\Currency\CurrencyCodeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'             => 'required|string',
            'description'       => 'nullable|string',
            'introduction'      => 'nullable|string',
            'charity'           => 'required|decimal:2|max:100',
            'amount'            => 'required|decimal:2,18',
            'currency'          => 'required|integer|in:' . CurrencyCodeEnum::getImplodedValues(),
            'period'            => 'required|integer',
            'entry_fee'         => 'required|decimal:2,18',
            'capacity'          => 'required|integer',
            'trials'            => 'nullable|integer',
            'refundable'        => 'nullable|boolean',
            'invite_only'       => 'nullable|boolean',
            'private'           => 'nullable|boolean',
            'webhook'           => 'nullable|string',
            'subscribable_id'   => 'required|string',
            'subscribable_type' => 'required|string',
        ];
    }
}
