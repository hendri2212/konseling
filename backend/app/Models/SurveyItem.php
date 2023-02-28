<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyItem extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function requirementFormulation() {
        return $this->belongsTo(RequirementFormulation::class, 'requirement_formulation_id', 'id');
    }

    public function surveyResponse() {
        return $this->hasOne(SurveyResponse::class, 'survey_item_id', 'id');
    }

}
