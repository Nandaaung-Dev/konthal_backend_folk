<?php

namespace App\Http\Resources\V1\Owner;

use App\Http\Resources\V1\City\CityResource;
use App\Http\Resources\V1\Shop\ShopCollection;
use App\Http\Resources\V1\Township\TownshipResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'viber_number' => $this->viber_number,
            'city_id' => $this->city_id,
            'township_id' => $this->township_id,
            'address' => $this->address,
            'township' => TownshipResource::make($this->whenLoaded('township')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'shops' => ShopCollection::make($this->whenLoaded('shops'))

        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
