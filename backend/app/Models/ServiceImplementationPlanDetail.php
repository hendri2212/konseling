<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImplementationPlanDetail extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function child()
    {
        return $this->hasMany(ServiceImplementationPlanDetail::class, 'parent_id', 'id')->with('child');
    }
}
