<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skkpd extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "skkpd";

    public function bidang() {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
}
