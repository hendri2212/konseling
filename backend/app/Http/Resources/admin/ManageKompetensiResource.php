<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ManageKompetensiResource extends JsonResource
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
            'skkpd' => $this->skkpd,
            'pengenalan' => $this->pengenalan,
            'akomodasi' => $this->akomodasi,
            'tindakan' => $this->tindakan
        ];
    }
}
