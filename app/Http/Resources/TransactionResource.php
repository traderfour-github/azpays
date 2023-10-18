<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => $this->amount,
            'payee_description' => $this->description,
            'payer_description' => $this->user_description,
            'authority' => $this->authority,
            'trace_number' => $this->trace_number,
            'currency' => $this->currency,
            'verified_at' => $this->verified_at,
            'status' => $this->status,
            'payer' => $this->payer->name,
            'payee' => $this->payee->name,
            'transactional' => $this->transactional,
            'gateway' => GatewayResource::make($this->gateway),
            'network' => NetworkResource::make($this->network),
        ];
    }
}
