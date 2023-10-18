<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\NetworkResource;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

class PayResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            Payment::ID => $this->{Payment::ID},
            Payment::TOKEN => $this->{Payment::TOKEN},
            Payment::AMOUNT => $this->{Payment::AMOUNT},
            Payment::CURRENCY => $this->{Payment::CURRENCY},
            Payment::FACTOR => $this->{Payment::FACTOR},
            Payment::DESCRIPTION => $this->{Payment::DESCRIPTION},
            Payment::STARTED_AT => $this->{Payment::STARTED_AT},
            Payment::VERIFIED_AT => $this->{Payment::VERIFIED_AT},
            Payment::STATUS => $this->{Payment::STATUS},
            'transfer_wallet_address' => $this->whenHas('transfer_wallet_address', $this->transfer_wallet_address),
            'transfer_amount' => $this->whenHas('transfer_amount', $this->transfer_amount),
            'networks' => $this->whenHas('networks', fn() => NetworkResource::collection($this->networks)),
        ];
    }
}
