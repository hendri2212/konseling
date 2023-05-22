<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function surveyItem()
    {
        return $this->belongsTo(SurveyItem::class, 'survey_item_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function scopeWhereSurveyAttemptId($query, $survey_attempt_id)
    {
        return $query->where("survey_attempt_id", $survey_attempt_id);
    }

    public function scopeJoinSurveyAttempt($query)
    {
        return $query->join("survey_attempts", "survey_attempts.id", "=", "survey_responses.survey_attempt_id");
    }

    public function scopeJoinSurveyItems($query)
    {
        return $query->join("survey_items", "survey_items.id", "=", "survey_responses.survey_item_id");
    }

    public function scopeJoinSurveyAttemptAndWhereSurveyId($query, $survey_id)
    {
        return $query->join("survey_attempts", "survey_attempts.id", "=", "survey_responses.survey_attempt_id")->where("survey_attempts.survey_id", $survey_id);
    }

    // public function scopeJoinServiceImplemenationPlanAndWhereSurveyId($query, $survey_id)
    // {
    //     // return $query->leftJoin("service_implementation_plans", "service_implementation_plans.survey_item_id", "=", "survey_responses.survey_item_id")->where("service_implementation_plans.survey_id", $survey_id);
    //     return $query->leftJoin("service_implementation_plans", function (JoinClause $join) {
    //         $join->on('users.id', '=', 'contacts.user_id')
    //              ->where('contacts.user_id', '>', 5);
    //     });
    // }
}
