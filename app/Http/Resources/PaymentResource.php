<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'token'         => $this->token,
            'amount'        => $this->amount,
            'currency'      => $this->currency,
            'factor'        => $this->factor,
            'description'   => $this->description,
            'started_at'   => $this->started_at,
            'verified_at'   => $this->verified_at,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
