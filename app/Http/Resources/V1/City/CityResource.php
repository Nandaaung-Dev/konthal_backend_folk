<?php

namespace App\Http\Resources\V1\City;

use App\Http\Resources\V1\Region\RegionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'region_id' => $this->region_id,
            'region' => RegionResource::make($this->whenLoaded('region'))
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
