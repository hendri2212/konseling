<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListSurveyItemResource;
use App\Http\Resources\siswa\ListSurveyItemResource as SiswaListSurveyItemResource;
use App\Http\Resources\SurveyItemResource;
use App\Models\SurveyResponse;
use App\Models\SurveyItem;
use App\Models\Survey;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SurveyItemController extends Controller
{

    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSurveyItem()
    {
        try {
            $student_id = auth()->id();
            $class_id = auth()->user()->class_id;
            $angket = Survey::where('class_id', $class_id)->where('status', 'open')->first();
            if ($angket) {
                $survey_items = SurveyItem::with(['survey_responses' => function ($q) use ($student_id, $angket) {
                    return $q->where('student_id', $student_id)->where('survey_id', $angket->id);
                }])->get()->map(function ($user, $key) {
                    $user->num = $key + 1;
                    return $user;
                });
                $data = SiswaListSurveyItemResource::collection($survey_items);
                return $this->responseRepository->ResponseSuccess($data);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    public function index()
    {
        try {
            $student_id = auth()->id();
            $class_id = auth()->user()->class_id;
            $angket = Survey::where('class_id', $class_id)->where('status', 'open')->first();
            if ($angket) {
                $survey_items = SurveyItem::with(['survey_responses' => function ($q) use ($student_id, $angket) {
                    return $q->where('student_id', $student_id)->where('survey_id', $angket->id);
                }])->paginate(1);
                $data = SurveyItemResource::collection($survey_items);
                return $this->responseRepository->ResponseSuccess($data);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    public function jawab(Request $request)
    {
        // return "tes";
        $validator = Validator::make($request->all(), [
            'id' => "required",
            'survey_responses' => "required",
        ]);
        if ($validator->fails()) {
            return $this->responseRepository->ResponseError("Parameter not found!", "Paramter not found!", 422);
        }
        $student_id = auth()->id();
        $class_id = auth()->user()->class_id;
        try {
            $angket = Survey::where('class_id', $class_id)->where('status', 'open')->first();
            if ($angket) {
                $check_jawaban = SurveyResponse::where('student_id', $student_id)
                    ->where('survey_id', $angket->id)
                    ->where('survey_item_id', $request->id)->first();
                if ($check_jawaban) {
                    $check_jawaban->answer = $request->answer;
                    $check_jawaban->updated_at = round(microtime(true) * 1000);
                    $check_jawaban->save();
                } else {
                    $survey_response = new SurveyResponse;
                    $survey_response->id = Str::uuid();
                    $survey_response->answer = $request->answer;
                    $survey_response->student_id = $student_id;
                    $survey_response->survey_id = $angket->id;
                    $survey_response->survey_item_id = $request->id;
                    $survey_response->created_at = round(microtime(true) * 1000);
                    $survey_response->save();
                }
                return $this->responseRepository->ResponseSuccess([
                    'Berhasil set jawaban'
                ]);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
