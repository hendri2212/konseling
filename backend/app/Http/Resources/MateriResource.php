<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MateriResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'komponen_layanan' => new KomponenLayananResource($this->whenLoaded('komponen_layanan'))
        ];
    }
}
