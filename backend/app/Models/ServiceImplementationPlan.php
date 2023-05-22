<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImplementationPlan extends Model
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
        return $this->hasOne(SurveyItem::class, 'id', 'survey_item_id');
    }

    public function serviceImplementationPlanDetails()
    {
        return $this->hasMany(ServiceImplementationPlanDetail::class, 'service_implementation_plan_id', 'id');
    }
}
