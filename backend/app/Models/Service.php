<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function Permission() {
        return $this->hasMany(Permission::class, 'service_id', 'id');
    }
}
