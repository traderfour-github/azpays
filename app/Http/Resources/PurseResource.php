<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'currency'  => $this->currency,
            'note'      => $this->note,
            'type'    => $this->type,
            'status'    => $this->status,
            'address'   => $this->address,
            'color'     => $this->color ,
            'balance'   => $this->balance,
            'freeze'    => $this->freeze,
            'locked'    => $this->locked,
            'purse_user'    => PurseUserResource::make($this->purseUser),
        ];
    }
}
