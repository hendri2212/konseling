<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RumusanKebutuhanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'tujuan_layanan' => $this->tujuan_layanan,
            'materi' => new MateriResource($this->whenLoaded('materi')),
            'skkpd' => new SkkpdResource($this->whenLoaded('skkpd'))
        ];
    }
}
