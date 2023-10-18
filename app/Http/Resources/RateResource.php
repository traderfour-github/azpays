<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Rate::ID => $this->{Rate::ID},
            Rate::NETWORK_ID => $this->{Rate::NETWORK_ID},
            Rate::BASE => $this->{Rate::BASE},
            Rate::CURRENCY => $this->{Rate::CURRENCY},
            Rate::SELL => $this->{Rate::SELL},
            Rate::BUY => $this->{Rate::BUY},
            Rate::DESCRIPTION => $this->{Rate::DESCRIPTION},
        ];
    }
}
