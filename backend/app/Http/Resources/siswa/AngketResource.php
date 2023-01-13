<?php

namespace App\Http\Resources\siswa;

use Illuminate\Http\Resources\Json\JsonResource;

class AngketResource extends JsonResource
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
            'nama' => strtoupper($this->nama),
            'tanggal' => $this->tanggal,
            'status' => $this->status,
        ];
    }
}
