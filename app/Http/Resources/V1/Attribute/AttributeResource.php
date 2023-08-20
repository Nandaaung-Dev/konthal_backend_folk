<?php

namespace App\Http\Resources\V1\Attribute;

use App\Http\Resources\V1\Attribute\AttributeCollection;
use App\Http\Resources\V1\Shop\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_mm' => $this->name_mm,
            'shop_id' => $this->shop_id,
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'attribute_values' => AttributeCollection::make($this->whenLoaded('attribute_values'))


        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
