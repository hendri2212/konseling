<?php

namespace App\Http\Resources\guru;

use App\Http\Resources\SiswaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
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
            'nama' => $this->nama,
            // 'siswa' => SiswaResource::collection($this->siswa)
        ];
    }
}
