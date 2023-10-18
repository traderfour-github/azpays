<?php

namespace App\Http\Requests\Subscription;

use App\Enums\Currency\CurrencyCodeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'             => 'string',
            'description'       => 'nullable|string',
            'introduction'      => 'nullable|string',
            'subscribable_id'   => 'string',
            'subscribable_type' => 'string',
            'charity'           => 'nullable|decimal:2|max:100',
            'amount'            => 'decimal:2,18',
            'currency'          => 'integer|in:' . CurrencyCodeEnum::getImplodedValues(),
            'period'            => 'integer',
            'entry_fee'         => 'decimal:2,18',
            'capacity'          => 'integer',
            'trials'            => 'integer',
            'refundable'        => 'boolean',
            'invite_only'       => 'boolean',
            'private'           => 'boolean',
            'webhook'           => 'nullable|string',
        ];
    }
}
