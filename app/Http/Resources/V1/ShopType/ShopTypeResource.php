<?php

namespace App\Http\Resources\V1\ShopType;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopTypeResource extends JsonResource
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
            'name_mm'=> $this->name_mm,
            'description' => $this->description
        ];
    }
    public function with($request) 
    {
        return ['status'=>1];
    }
}
