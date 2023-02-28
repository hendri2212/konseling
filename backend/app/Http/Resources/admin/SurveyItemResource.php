<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyItemResource extends JsonResource
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
            'question' => $this->question,
            'requirement_formulation' =>  new RequirementFormulationResource($this->whenLoaded('requirementFormulation')),
        ];
        // 'field_component' => $this->rumusan_kebutuhan?->skkpd?->field_component,
    }
}
