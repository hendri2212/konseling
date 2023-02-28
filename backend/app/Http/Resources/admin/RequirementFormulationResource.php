<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class RequirementFormulationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'service_objective' => $this->service_objective,
            'topic' => new TopicResource($this->whenLoaded('topic')),
            'skkpd' => new SkkpdResource($this->whenLoaded('skkpd'))
        ];
    }
}
