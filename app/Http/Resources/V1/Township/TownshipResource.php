<?php

namespace App\Http\Resources\V1\Township;

use App\Http\Resources\V1\City\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TownshipResource extends JsonResource
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
            'city_id'=>$this->city_id,
            'city' => CityResource::make($this->whenLoaded('city'))
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
