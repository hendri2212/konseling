<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkkpdResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'pengenalan' => $this->pengenalan,
            'akomodasi' => $this->akomodasi,
            'tindakan' => $this->tindakan,
            'bidang' => new BidangResource($this->whenLoaded('bidang'))
        ];
    }
}
