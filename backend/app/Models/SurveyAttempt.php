<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAttempt extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'timestart',
        'timefinish',
        'created_at',
        'updated_at',
    ];

    /** @var string to identify the in progress state. */
    const IN_PROGRESS = 'inprogress';
    /** @var string to identify the finished state. */
    const FINISHED    = 'finished';

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function surveyResponses() {
        return $this->hasMany(SurveyResponse::class, 'survey_attempt_id', 'id');
    }

    public function scopeWhereClassId($query, $id) {
        return $query->where('class_id', $id);
    }

    public function scopeWhereSurveyId($query, $id) {
        return $query->where('survey_id', $id);
    } 

    public function scopeWithStudent ($query) {
        return $query->with('student');
    }

    public function scopeWhereOpen($query) {
        return $query->where('status', 'open');
    }

}
