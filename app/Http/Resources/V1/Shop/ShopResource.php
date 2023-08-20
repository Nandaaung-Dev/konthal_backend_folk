<?php

namespace App\Http\Resources\V1\Shop;

use App\Http\Resources\V1\Branch\BranchCollection;
use App\Http\Resources\V1\Category\CategoryCollection;
use App\Http\Resources\V1\City\CityResource;
use App\Http\Resources\V1\Owner\OwnerResource;
use App\Http\Resources\V1\Product\ProductCollection;
use App\Http\Resources\V1\ShopStaff\ShopStaffCollection;
use App\Http\Resources\V1\ShopType\ShopTypeResource;
use App\Http\Resources\V1\Township\TownshipResource;
use App\Models\City;
use App\Models\ShopType;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'slug' => $this->slug,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'description' => $this->description,
            'logo_image' => $this->logo_image ?? url('/shop/sample_logo/image.webp'),
            'status' => $this->status,
            // 'shop_type_id' => $this->shop_type_id,
            // 'owner_id' => $this->owner_id,
            // 'city_id' => $this->city_id,
            // 'township_id' => $this->township_id,
            'owner' => OwnerResource::make($this->whenLoaded('owner')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'township' => TownshipResource::make($this->whenLoaded('township')),
            'shop_type' => ShopTypeResource::make($this->whenLoaded('shop_type')),
            'branches' => BranchCollection::make($this->whenLoaded('branches')),
            'categories' => CategoryCollection::make($this->whenLoaded('categories')),
            'products' => ProductCollection::make($this->whenLoaded('products')),
            'shop_staffs' => ShopStaffCollection::make($this->whenLoaded('shop_staffs'))

        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
