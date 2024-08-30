<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\SurveyAttemptResource;
use App\Http\Resources\admin\SurveyAttemptResultPerSurveyItemsResource;
use App\Http\Resources\siswa\SurveyResource;
use App\Models\Survey;
use App\Models\SurveyAttempt;
use App\Models\SurveyItem;
use App\Models\SurveyResponse;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class SurveyAttemptController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function resultOfSurveys($survey_id, Request $request)
    {
        // SELECT students.name as nama, sum(answer) as answer_sum FROM `survey_responses` INNER JOIN survey_attempts ON survey_attempts.id=survey_responses.survey_attempt_id INNER JOIN students ON students.id=survey_attempts.student_id WHERE survey_attempts.survey_id="94757351-03a4-4fea-8cad-b16a60e396f2" GROUP BY survey_attempt_id;
        try {
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $query_attempts = SurveyAttempt::select("survey_attempts.*", "surveys.number_of_survey_items")->withStudent()->where("survey_id", $survey_id)->join("surveys", "surveys.id", "=", "survey_attempts.survey_id");
            $count_attempts = count($query_attempts->get());
            $attempts = $query_attempts->paginate($max);
            $data = SurveyAttemptResource::collection($attempts);
            $pagination = [
                'max_page' => ceil($count_attempts / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('surveys.result_of_surveys', ['survey_id' => $survey_id, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function resultOfSurveysPerSurveyItems(Request $request, $survey_id)
    {
        try {
            $sum_result_of_survey_items = SurveyResponse::JoinSurveyAttemptAndwhereSurveyId($survey_id)->count();
            $databaseDriver = Config::get('database.default');
            if ($databaseDriver === 'mysql') {
                $query_sum_as_float = "CAST(SUM(answer) AS FLOAT)";
            } elseif ($databaseDriver === 'pgsql') {
                $query_sum_as_float = "SUM(answer)::float";
            }
            $result_per_survey_items = SurveyResponse::with(["surveyItem.serviceImplementationPlan" => function ($q) use ($survey_id) {
                $q->where('survey_id', $survey_id);
            }])->joinSurveyAttemptAndwhereSurveyId($survey_id)->select("survey_items.id as survey_item_id", "survey_items.order", "survey_items.question", DB::raw("SUM(answer) as result, ($query_sum_as_float / $sum_result_of_survey_items * 100) as result_as_percent, sum(case when answer=1 then 1 else 0 end) as students_count"))->joinSurveyItems()->groupBy("survey_items.id", "survey_items.question", "survey_items.order")->orderBy("order");

            if (isset($request->filter_by_service_strategy)) {
                $result_per_survey_items = $result_per_survey_items->where("survey_items.service_strategy", $request->filter_by_service_strategy);
            }
            $data = SurveyAttemptResultPerSurveyItemsResource::collection($result_per_survey_items->get());
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
}
