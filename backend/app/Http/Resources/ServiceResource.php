<?php

namespace App\Http\Resources;

use App\Http\Resources\admin\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service' => $this->service,
            'description' => $this->description,
            'permission' => PermissionResource::collection($this->permission)
        ];
    }


}
