<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanKebutuhan extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "rumusan_kebutuhan";

    public function skkpd() {
        return $this->belongsTo(Skkpd::class, 'skkpd_id', 'id');
    }

    public function materi() {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }
}
