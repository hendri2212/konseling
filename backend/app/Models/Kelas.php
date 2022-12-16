<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $keyType = 'string';
    public $incrementing = false;

    public function guru() {
        return $this->belongsTo(GuruUser::class, 'guru_id', 'id');
    }

    public function siswa() {
        return $this->hasMany(SiswaUser::class, 'kelas_id', 'id');
    }

    public function angket() {
        return $this->hasMany(Angket::class, 'kelas_id', 'id');
    }
}
