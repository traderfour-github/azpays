<?php

namespace App\Http\Resources;

use App\Models\Network;
use Illuminate\Http\Resources\Json\JsonResource;

class NetworkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Network::ID => $this->{Network::ID},
            Network::GATEWAY_ID => $this->{Network::GATEWAY_ID},
            Network::NAME => $this->{Network::NAME},
            Network::FEE => $this->{Network::FEE},
            Network::SUPPORT_PORTAL => $this->{Network::SUPPORT_PORTAL},
            Network::SUPPORT_EMAIL => $this->{Network::SUPPORT_EMAIL},
            Network::SUPPORT_PHONE => $this->{Network::SUPPORT_PHONE},
            Network::PROCESSING_TIME => $this->{Network::PROCESSING_TIME},
            Network::CONFIRM_TIME => $this->{Network::CONFIRM_TIME},
            Network::PAYOUT_TIME => $this->{Network::PAYOUT_TIME},
            Network::COUNTRIES => $this->{Network::COUNTRIES},
            Network::PROCESSORS => $this->{Network::PROCESSORS},
            Network::LOGO => $this->{Network::LOGO},
            'gateway' => $this->whenHas('gateway', fn() => new GatewayResource($this->gateway)),
        ];
    }
}
