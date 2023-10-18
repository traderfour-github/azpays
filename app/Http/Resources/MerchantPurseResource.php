<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantPurseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'purse_id' => $this->purse_id,
            'percentage' => $this->percentage,
            'fee' => $this->fee,
        ];
    }
}
