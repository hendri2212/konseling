<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SkkpdResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'introduction' => $this->introduction,
            'accommodation' => $this->accommodation,
            'action' => $this->action,
            'field_component' => new FieldComponentResource($this->whenLoaded('fieldComponent'))
        ];
    }
}
