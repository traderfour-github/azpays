<?php

namespace App\Http\Requests\Discount;

use App\Enums\Discount\DiscountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'code'             => 'string|min:6|unique:discounts,code',
            'description'      => 'nullable|string',
            'type'             => 'required|integer|in:' . DiscountTypeEnum::getImplodedValues(),
            'value'            => 'required|numeric',
            'max_value'        => 'nullable|numeric',
            'max_use'          => 'nullable|integer',
            'max_use_per_user' => 'nullable|integer',
            'first_purchase'   => 'nullable|boolean',
            'start_at'         => 'nullable|date_format:Y-m-d H:i:s',
            'expired_at'       => 'required|date_format:Y-m-d H:i:s',
            'subscriptions'    => 'required|array',
            'subscriptions.*'  => 'required|uuid|exists:subscriptions,id',
        ];
    }
}
