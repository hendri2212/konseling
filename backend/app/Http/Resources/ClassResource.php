<?php

namespace App\Http\Resources;

use App\Http\Resources\sekolah\TeacherResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'number_of_students' => $this->when(isset($this->students_count), $this->students_count),
        ];
    }
}
