<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'              => $this->id,
            'title'             => $this->title,
            'description'       => $this->description,
            'introduction'      => $this->introduction,
            'subscribable_id'   => $this->subscribable_id,
            'subscribable_type' => $this->subscribable_type,
            'charity'           => $this->charity,
            'amount'            => $this->amount,
            'currency'          => $this->currency,
            'period'            => $this->period,
            'entry_fee'         => $this->entry_fee,
            'capacity'          => $this->capacity,
            'trials'            => $this->trials,
            'refundable'        => $this->refundable,
            'invite_only'       => $this->invite_only,
            'private'           => $this->private,
            'webhook'           => $this->webhook,
            'status'            => $this->status,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
