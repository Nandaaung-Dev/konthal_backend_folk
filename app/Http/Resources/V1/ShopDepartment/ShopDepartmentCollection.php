<?php

namespace App\Http\Resources\V1\ShopDepartment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopDepartmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
