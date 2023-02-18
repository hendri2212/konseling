<?php

namespace App\Models;

use App\Http\Resources\JawabanSiswaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angket extends Model
{
    use HasFactory;

    protected $table = "angket";
    protected $keyType = 'string';
    public $incrementing = false;

    public function getJawabanSiswaAttribute() {
        $siswa = $this->kelas->siswa;
        // return $siswa;
        foreach ($siswa as $data) {
            $jawaban = Jawaban::where([
                'siswa_id' => $data->id,
                'angket_id' => $this->id
            ])->get();
            $data['jawaban'] = $jawaban;
        }
        return JawabanSiswaResource::collection($siswa);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'angket_id', 'id');
    }

    public function attempt() {
        return $this->hasOne(AngketAttempt::class, 'angket_id', 'id');
    }
}
