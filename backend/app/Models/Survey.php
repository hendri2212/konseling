<?php

namespace App\Models;

use App\Http\Resources\SurveyResponseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function getSurveyResponseAttribute() {
        $students = $this->class->students;
        foreach ($students as $data) {
            $survey_responses = SurveyResponse::where([
                'student_id' => $data->id,
                'survey_id' => $this->id
            ])->get();
            $data['survey_responses'] = $survey_responses;
        }
        return SurveyResponseResource::collection($students);
    }

    public function class() {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function surveyResponses() {
        return $this->hasMany(SurveyResponse::class, 'survey_id', 'id');
    }

    public function surveyAttempt() {
        return $this->hasOne(SurveyAttempt::class, 'survey_id', 'id');
    }
}
