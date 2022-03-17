<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $keyType = 'string';
    public $incrementing = false;

    public function soal() {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }

    public function siswa() {
        return $this->belongsTo(SiswaUser::class, 'siswa_id', 'id');
    }
}
