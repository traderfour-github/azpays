<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'              => $this->id,
            'code'              => $this->code,
            'description'       => $this->description,
            'type'              => $this->type,
            'value'             => $this->value,
            'max_value'         => $this->max_value,
            'max_use'           => $this->max_use,
            'max_use_per_user'  => $this->max_use_per_user,
            'first_purchase'    => $this->first_purchase,
            'start_at'          => $this->start_at,
            'expired_at'        => $this->expired_at,
            'status'            => $this->status,
            'subscriptions'     => SubscriptionResource::collection($this->subscriptions),
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
