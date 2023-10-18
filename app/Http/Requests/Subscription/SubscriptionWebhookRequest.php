<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionWebhookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'accounts' => ['required', 'integer'],
            'profit' => ['required', 'integer'],
            'subscription_purchase_id' => ['required', 'string', 'exists:subscription_purchases,id'],
        ];
    }
}
