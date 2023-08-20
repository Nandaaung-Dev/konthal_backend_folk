<?php

namespace App\Http\Resources\V1\Provider;

use App\Http\Resources\V1\City\CityResource;
use App\Http\Resources\V1\ProviderBranche\ProviderBrancheCollection;
use App\Http\Resources\V1\Township\TownshipResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            // 'city_id'=>$this->city_id,
            // 'township_id'=>$this->township_id,
            'city' => CityResource::make($this->whenLoaded('city')),
            'township' => TownshipResource::make($this->whenLoaded('township')),
            'provider_branches'=>ProviderBrancheCollection::make($this->whenLoaded('provider_branches'))

        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
