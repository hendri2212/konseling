<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $keyType = 'string';
    public $incrementing = false;

    public function bidang() {
        return $this->hasOne(Bidang::class, 'id', 'bidang_id');
    }

    public function kompetensi() {
        return $this->hasOne(Kompetensi::class, 'id', 'kompetensi_id');
    }

    public function jawaban() {
        return $this->hasOne(Jawaban::class, "soal_id", "id");
    }

}
