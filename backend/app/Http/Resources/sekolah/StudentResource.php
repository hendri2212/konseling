<?php

namespace App\Http\Resources\sekolah;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
        ];
        return $response;
    }
}
