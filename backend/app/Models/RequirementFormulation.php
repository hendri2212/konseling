<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementFormulation extends Model
{
    use HasFactory;

    protected $table = "requirements_formulation";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function skkpd() {
        return $this->belongsTo(Skkpd::class, 'skkpd_id', 'id');
    }

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
}
