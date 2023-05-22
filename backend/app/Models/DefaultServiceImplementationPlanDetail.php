<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultServiceImplementationPlanDetail extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    // public function service_implementation_plan_details()
    // {
    //     return $this->hasMany(DefaultServiceImplementationPlanDetail::class);
    // }

    public function child()
    {
        return $this->hasMany(DefaultServiceImplementationPlanDetail::class)->with('child');
    }
}
