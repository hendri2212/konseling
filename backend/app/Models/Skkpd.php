<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skkpd extends Model
{
    use HasFactory;

    protected $table = "skkpd";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function fieldComponent() {
        return $this->belongsTo(FieldComponent::class, 'field_component_id', 'id');
    }
}
