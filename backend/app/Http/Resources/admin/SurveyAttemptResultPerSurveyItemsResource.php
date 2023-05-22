<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Cast\Double;

class SurveyAttemptResultPerSurveyItemsResource extends JsonResource
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
            'id' => $this->survey_item_id,
            'order' => $this->order,
            'question' => $this->question,
            'students_count' => (int) $this->students_count,
            'result' => (int) $this->result,
            'result_as_percent' => (float) $this->result_as_percent,
            'have_sip' => count($this->surveyItem->serviceImplementationPlan) > 0,
        ];
    }
}
