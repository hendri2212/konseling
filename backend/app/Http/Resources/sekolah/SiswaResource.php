<?php

namespace App\Http\Resources\sekolah;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'username' => $this->username,
            'nama' => $this->nama,
        ];
        return $response;
    }
}
