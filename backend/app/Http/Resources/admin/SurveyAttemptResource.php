<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyAttemptResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->student->id,
            'name' => $this->student->name,
            'result' => (int) $this->sumgrades,
            'result_as_percent' => $this->sumgrades / $this->number_of_survey_items * 100,
            'state' => $this->state,
            'timestart' => $this->timestart,
            'timefinish' => $this->timefinish,
            'time' => $this->timefinish - $this->timestart
        ];
    }
}
