<?php

namespace App\Http\Resources\siswa;

use Illuminate\Http\Resources\Json\JsonResource;

class ListSurveyItemResource extends JsonResource
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
            'order' => $this->order,
            'answered' => $this->surveyResponse != null ? true : false,
        ];
    }
}
