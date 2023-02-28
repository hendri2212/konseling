<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;
use App\Models\SurveyItem;
use Illuminate\Support\Facades\DB;

class ClassAnalysisController extends Controller
{
    public function class_profile($id){
        $allResponden = SurveyItem::leftJoin('survey_responses', 'survey_responses.survey_item_id','=', 'survey_items.id')
        ->where('survey_responses.survey_id', $id)
        ->select(DB::raw("sum(answer) responden"))
        ->first()->responden;
        $data_per_field_component = SurveyItem::leftJoin('survey_responses', 'survey_responses.survey_item_id','=', 'survey_items.id')
        ->join('field_component', 'survey_items.field_component_id', '=', 'field_component.id')
        ->where('survey_responses.survey_id', $id)
        ->groupBy('survey_items.field_component_id', 'field_component.name')
        ->select(DB::raw("field_component.name as field_component, sum(answer) responden, sum(answer)/$allResponden*100 prosentase"))
        ->get();
        $data = SurveyItem::leftJoin('survey_responses', 'survey_responses.survey_item_id','=', 'survey_items.id')
        ->where('survey_responses.survey_id', $id)
        ->groupBy('survey_items.id', 'survey_items')
        ->select(DB::raw("survey_items, sum(jawaban) responden, sum(jawaban)/$allResponden*100 prosentase"))
        ->get()->map(function($survey_item, $key) {
            $survey_item->no = $key+1;
            $survey_item->prosentase = round($survey_item->prosentase, 1) . '%';
            $survey_item->prioritas = $survey_item->prosentase >= 2 ? "TINGGI" : ($survey_item->prosentase >= 1 ? "SEDANG" : "RENDAH");
            return $survey_item;
        });
        $label = $data_per_field_component->map(function($p){
            return $p->field_component . ' ' . '(' . round($p->prosentase, 1) . '%)';
        });
        $data_akumulasi = $data_per_field_component->map(function($p){
            return $p->responden;
        });
        $data_prosentase = $data_per_field_component->map(function($p){
            return round($p->prosentase, 1) . '%';
        });
        return [
            'list' => $data,
            'akumulasi' => [
                'label' => $label,
                'data' => $data_akumulasi,
                'prosentase' => $data_prosentase,
            ]
        ];
    }

    public function profile_konseling($id){
        $data = SurveyResponse::leftJoin('students', 'survey_responses.student_id','=', 'students.id')
        ->where('survey_responses.survey_id', $id)
        ->groupBy('students.id', 'students.nisn', 'students.name')
        ->select(DB::raw("nisn, name, sum(jawaban) jumlah, sum(jawaban)/50*100 prosentase"))
        ->get()->map(function($student, $key) {
            $student->no = $key+1;
            $student->prosentase = round($student->prosentase, 1) . '%';
            return $student;
        });
        return $data;
    }
}
