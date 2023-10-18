<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountVerifyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'code'  => $this->code,
            'type'  => $this->type,
            'value' => $this->value,
        ];
    }
}
