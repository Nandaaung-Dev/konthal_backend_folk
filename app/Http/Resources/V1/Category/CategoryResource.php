<?php

namespace App\Http\Resources\V1\Category;

use App\Http\Resources\V1\Type\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'icon' => $this->icon,
            'image' => $this->image,
            'detail' => $this->detail,
            'type_id' => $this->type_id,
            'type' => TypeResource::make($this->whenLoaded('type'))
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
