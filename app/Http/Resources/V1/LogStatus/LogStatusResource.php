<?php

namespace App\Http\Resources\V1\LogStatus;

use Illuminate\Http\Resources\Json\JsonResource;

class LogStatusResource extends JsonResource
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
            'serial' => $this->serial,
            'color' => $this->color
        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
