<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "question" => $this->question,
            "answer" => $this->answer,
            "answered" => $this->answer != null ? true : false,
        ];
    }
}
