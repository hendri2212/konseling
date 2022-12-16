<?php

namespace App\Http\Resources;

use App\Http\Resources\sekolah\GuruResource;
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
            'guru' => new GuruResource($this->whenLoaded('guru')),
            'jumlah_siswa' => $this->when(isset($this->siswa_count), $this->siswa_count),
        ];
    }
}
