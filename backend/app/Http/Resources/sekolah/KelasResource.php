<?php

namespace App\Http\Resources\sekolah;

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
        $response = [
            'id' => $this->id,
            'nama' => $this->nama,
        ];
        if (isset($this->guru)) {
            $response['guru'] = $this->guru;
        }
        return $response;
    }
}
