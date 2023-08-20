<?php

namespace App\Http\Resources\V1\Product;

use App\Http\Resources\V1\Branch\BranchResource;
use App\Http\Resources\V1\Brand\BrandResource;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\MainCategory\MainCategoryResource;
use App\Http\Resources\V1\ProductAttribute\ProductAttributeCollection;
use App\Http\Resources\V1\Shop\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price' => $this->price,
            'description' => $this->description,
            'shop_id' => $this->shop_id,
            'main_category_id' => $this->main_category_id,
            'product_type' => $this->product_type,
            'brand_id' => $this->brand_id,
            'branch_id' => $this->branch_id,
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'main_category' => MainCategoryResource::make($this->whenLoaded('main_category')),
            'branch' => BranchResource::make($this->whenLoaded('branch')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'product_attributes' => ProductAttributeCollection::make($this->whenLoaded('product_attributes'))


        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
