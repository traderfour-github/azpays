<?php

namespace App\Http\Resources;

use App\Models\Gateway;
use Illuminate\Http\Resources\Json\JsonResource;

class GatewayResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Gateway::ID => $this->{Gateway::ID},
            Gateway::NAME => $this->{Gateway::NAME},
            Gateway::LOGO => $this->{Gateway::LOGO},
            Gateway::STATUS => $this->{Gateway::STATUS},
        ];
    }
}
