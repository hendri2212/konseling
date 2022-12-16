<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "materi";

    public function komponen_layanan() {
        return $this->belongsTo(KomponenLayanan::class, 'komponen_layanan_id', 'id');
    }
}
