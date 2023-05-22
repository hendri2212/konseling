<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\siswa\ListSurveyItemResource;
use App\Http\Resources\siswa\SurveyAttemptResource;
use App\Http\Resources\siswa\SurveyResource as SiswaSurveyResource;
use App\Models\Survey;
use App\Models\SurveyAttempt;
use App\Models\SurveyResponse;
use App\Models\SurveyItem;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }
    public function index(Request $request)
    {
        try {
            // $max = 10;
            // $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            // $class_id = ClassModel::where('teacher_id', auth()->id())->get()->pluck('id');
            // $count_all_angket = Survey::whereIn('class_id', $class_id)->count();
            $angket = Survey::where('class_id', auth()->user()->class_id)->get();
            $data = SiswaSurveyResource::collection($angket);
            // $pagination = [
            //     'max_page' => ceil($count_all_angket / $max),
            //     'next' => null
            // ];
            // if ($page < $pagination['max_page']) {
            //     $pagination['next'] = route('surveys.index', ['page' => $page + 1]);
            // }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $angket = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $data = new SiswaSurveyResource($angket);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function status($id)
    {
        try {

            $angket = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $id)->where('student_id', auth()->id())->first();

            $data =  $attempt ? new SurveyAttemptResource($attempt) : null;

            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }



    public function startAttempt($id)
    {
        try {
            $angket = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $angket->id)->where('student_id', auth()->id())->first();
            if (!$attempt) {
                $attempt = new SurveyAttempt();
                $attempt->id = Str::uuid();
                $attempt->survey_id = $id;
                $attempt->student_id = auth()->id();
                $attempt->school_id = auth()->user()->school->id;
                $attempt->created_at = round(microtime(true) * 1000);
                $attempt->timestart = round(microtime(true) * 1000);
                $attempt->save();
            }

            $data = new SurveyAttemptResource($attempt);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function finishAttempt($id)
    {
        try {
            $survey = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$survey) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $survey->id)->where('state', 'inprogress')->where('student_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("ATTEMPT_NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", 404);
            }

            $is_all_answered = SurveyResponse::whereSurveyAttemptId($attempt->id)->count() >= $survey->number_of_survey_items;
            if (!$is_all_answered) {
                return $this->responseRepository->ResponseError("HAS_QUESTION_NOT_ANSWERED", "Ada butir angket yang belum dijawab!", 422);
            }

            // menghitung nilai yang didapatkan
            // saat ini karena yang dibutuhkan hanya iya atau tidak
            // jadi nilai hanya 1 atau 0
            $attempt->sumgrades = SurveyResponse::whereSurveyAttemptId($attempt->id)->where("answer", 1)->count();
            $attempt->state = "finished";
            $attempt->timefinish = round(microtime(true) * 1000);
            $attempt->updated_at = round(microtime(true) * 1000);
            $attempt->save();

            $data = new SurveyAttemptResource($attempt);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function lists($id)
    {
        try {
            $angket = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $angket->id)->where('student_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", 404);
            }

            $lists = SurveyItem::with(['surveyResponse' => function ($query) use ($attempt) {
                $query->select('survey_item_id')->whereSurveyAttemptId($attempt->id);
            }])->orderBy('order', 'asc')->get();
            return $this->responseRepository->ResponseSuccess(ListSurveyItemResource::collection($lists), "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function surveyItemAndResponse(Request $request, $id)
    {
        try {
            $page = $request->page ? $request->page : 0;
            $survey = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$survey) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $survey->id)->where('student_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", 404);
            }

            $survey_item = SurveyItem::orderBy('order', 'asc')->skip($page)->take(1)->first();
            $survey_response = SurveyResponse::whereSurveyAttemptId($attempt->id)->where('survey_item_id', $survey_item->id)->first();
            $meta = [
                'number' => $survey_item->order,
                'next_number' => $survey_item->order == SurveyItem::max('order') ? null : $survey_item->order + 1,
                'previous_number' => $survey_item->order == SurveyItem::min('order') ? null : $survey_item->order - 1
            ];

            $data = [
                'survey_item' => $survey_item,
                'survey_response' => $survey_response,
                'meta' => $meta
            ];
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function answer(Request $request, $id, $id_survey_items)
    {
        try {
            $angket = Survey::where('class_id', auth()->user()->class_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Survey tidak ditemukan!", 404);
            }

            $attempt = SurveyAttempt::where('survey_id', $angket->id)->where('state', 'inprogress')->where('student_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", 404);
            }
            $survey_item = SurveyItem::find($id_survey_items);
            if (!$survey_item) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Butir angket tidak ditemukan!", 404);
            }

            $survey_response = SurveyResponse::whereSurveyAttemptId($attempt->id)->where('survey_item_id', $survey_item->id)->first();
            if (!$survey_response) {
                $survey_response = new SurveyResponse();
                $survey_response->id = Str::uuid();
                $survey_response->survey_attempt_id = $attempt->id;
                $survey_response->survey_item_id = $survey_item->id;
                $survey_response->created_at = round(microtime(true) * 1000);
            } else {
                $survey_response->updated_at = round(microtime(true) * 1000);
            }

            $survey_response->answer = $request->answer;
            $survey_response->save();

            return $this->responseRepository->ResponseSuccess("Berhasil", "Successfull", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
}
