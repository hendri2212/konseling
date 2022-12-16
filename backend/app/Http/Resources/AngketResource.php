<?php

namespace App\Http\Resources;

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
            'nama' => $this->nama,
            'tanggal' => $this->tanggal,
            // 'siswa' => $this->append('jawaban_siswa')->jawaban_siswa
            'kelas' => new KelasResource($this->kelas),
            'status' => $this->status,
        ];
    }
}
