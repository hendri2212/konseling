<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ButirAngketKonselingResource extends JsonResource
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
            'soal' => $this->soal,
            
            'rumusan_kebutuhan' =>  new RumusanKebutuhanResource($this->whenLoaded('rumusan_kebutuhan')),
        ];
        // 'bidang' => $this->rumusan_kebutuhan?->skkpd?->bidang,
    }
}
