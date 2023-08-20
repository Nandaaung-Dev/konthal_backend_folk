<?php

namespace App\Http\Resources\V1\ShopDepartment;

use App\Http\Resources\V1\Shop\ShopResource;


use Illuminate\Http\Resources\Json\JsonResource;

class ShopDepartmentResource extends JsonResource
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
            'shop' => ShopResource::make($this->whenLoaded('shop'))

        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
