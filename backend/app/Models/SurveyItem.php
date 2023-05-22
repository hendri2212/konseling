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

    // public static $service_strategy = [
    //     1 => "Bimbingan klasikal",
    //     2 => "Bimbingan kelompok",
    //     3 => "Konseling individual",
    //     4 => "Lintas kelas",
    // ];

    // public static function isServiceStrategyExists($service_strategy)
    // {
    //     return array_key_exists($service_strategy, self::$service_strategy);
    // }

    public function requirementFormulation()
    {
        return $this->belongsTo(RequirementFormulation::class, 'requirement_formulation_id', 'id');
    }

    public function surveyResponse()
    {
        return $this->hasOne(SurveyResponse::class, 'survey_item_id', 'id');
    }

    public function serviceImplementationPlan()
    {
        return $this->hasMany(ServiceImplementationPlan::class, 'survey_item_id', 'id');
    }
}
