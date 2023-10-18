<?php

namespace App\Http\Resources;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'tell'          => $this->tell,
            'domain'        => $this->domain,
            'ip'            => $this->ip,
            'description'   => $this->description,
            'support_email' => $this->support_email,
            'support_phone' => $this->support_phone,
            'support_url'   => $this->support_url,
            'color'         => $this->color,
            'logo'          => $this->logo,
            'status'        => $this->status,
            'merchant_purses' => MerchantPurseResource::collection($this->merchantUser),
            'tags'          => TagResource::collection($this->tags),
            'categories'    => CategoryResource::collection($this->categories),
        ];
    }
}
