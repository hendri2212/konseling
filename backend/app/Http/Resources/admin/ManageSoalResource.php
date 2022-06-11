<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ManageSoalResource extends JsonResource
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
            'rumusan_kebutuhan' => $this->rumusan_kebutuhan,
            'materi' => $this->materi,
            'tujuan_layanan' => $this->tujuan_layanan,
            'komponen_layanan' => $this->komponen_layanan,
            'strategi_layanan' => $this->strategi_layanan,
            'bidang' => new ManageBidangResource($this->bidang),
            'kompetensi' => new ManageKompetensiResource($this->kompetensi),
        ];
    }
}
