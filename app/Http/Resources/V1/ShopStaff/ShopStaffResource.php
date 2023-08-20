<?php

namespace App\Http\Resources\V1\ShopStaff;

use App\Http\Resources\V1\Branch\BranchResource;
use App\Http\Resources\V1\City\CityResource;
use App\Http\Resources\V1\Department\DepartmentResource;
use App\Http\Resources\V1\Shop\ShopResource;
use App\Http\Resources\V1\Township\TownshipResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopStaffResource extends JsonResource
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
            // 'city_id' => $this -> city_id,
            // 'township_id' => $this -> township_id,
            'address' => $this->address,
            'city' => CityResource::make($this->whenLoaded('city')),
            'township' => TownshipResource::make($this->whenLoaded('township')),
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'branch' => BranchResource::make($this->whenLoaded('branch')),
            'shop_department' => DepartmentResource::make($this->whenLoaded('shop_department'))
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
