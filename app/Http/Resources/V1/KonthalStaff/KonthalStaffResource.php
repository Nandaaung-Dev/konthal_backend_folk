<?php

namespace App\Http\Resources\V1\KonthalStaff;

use App\Http\Resources\V1\Department\DepartmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class KonthalStaffResource extends JsonResource
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
            'department' => DepartmentResource::make($this->whenLoaded('department')),

        ];
    }
    public function with($request)
    {
        return ['status' => 1];
    }
}
