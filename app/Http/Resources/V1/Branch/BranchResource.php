<?php

namespace App\Http\Resources\V1\Branch;

use App\Http\Resources\V1\City\CityResource;
use App\Http\Resources\V1\Product\ProductCollection;
use App\Http\Resources\V1\Shop\ShopResource;
use App\Http\Resources\V1\ShopType\ShopTypeResource;
use App\Http\Resources\V1\Township\TownshipResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'description' => $this->description,
            'shop_id' => $this->shop_id,
            'shop_type_id' => $this->shop_type_id,
            'city_id' => $this->city_id,
            'township_id' => $this->township_id,
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'shop_type' => ShopTypeResource::make($this->whenLoaded('shop_type')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'township' => TownshipResource::make($this->whenLoaded('township')),
            'products' => ProductCollection::make($this->whenLoaded('products'))


        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
