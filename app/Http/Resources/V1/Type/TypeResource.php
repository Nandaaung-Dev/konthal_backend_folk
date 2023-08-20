<?php

namespace App\Http\Resources\V1\Type;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
            'name_mm'=>$this->name_mm,
            'icon' => $this->icon,
            'image' => $this->image
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
