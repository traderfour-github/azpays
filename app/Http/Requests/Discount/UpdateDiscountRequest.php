<?php

namespace App\Http\Requests\Discount;

use App\Enums\Discount\DiscountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'description'      => 'nullable|string',
            'type'             => 'integer|in:' . DiscountTypeEnum::getImplodedValues(),
            'value'            => 'numeric',
            'max_value'        => 'numeric',
            'max_use'          => 'integer',
            'max_use_per_user' => 'integer',
            'first_purchase'   => 'boolean',
            'start_at'         => 'date_format:Y-m-d H:i:s',
            'expired_at'       => 'date_format:Y-m-d H:i:s',
            'subscriptions'    => 'array',
            'subscriptions.*'  => 'uuid|exists:subscriptions,id',
        ];
    }
}
