<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->created_at,
            'class' => [
                "name" => $this->class_name
            ],
            'status' => $this->status,
        ];
    }
}
