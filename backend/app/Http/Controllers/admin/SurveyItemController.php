<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SurveyItemRequest;
use App\Http\Resources\admin\SurveyItemResource;
use App\Models\SurveyItem;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SurveyItemController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_survey_items = SurveyItem::count();
            $survey_items = SurveyItem::with(['requirementFormulation.skkpd.fieldComponent', 'requirementFormulation.topic.serviceComponent'])->orderBy('order')->paginate($max);
            $data = SurveyItemResource::collection($survey_items);
            $pagination = [
                'max_page' => ceil($count_all_survey_items / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('survey-items.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(SurveyItemRequest $request)
    {
        try {
            $survey_item = new SurveyItem();
            $survey_item->id = Str::uuid();
            $survey_item->question = $request->question;
            $survey_item->requirement_formulation_id = $request->requirement_formulation_id;
            $last = SurveyItem::latest('order')->first()->order;
            $survey_item->order = $last+1;
            $survey_item->created_at = round(microtime(true) * 1000);
            $survey_item->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses membuat butir angket konseling", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal membuat butir angket konseling", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
        try {
            if (!SurveyItem::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan butir angket konseling", 'Butir angket konseling tidak ditemukan', 404);
            }
            $survey_item = SurveyItem::find($id);
            return $this->responseRepository->ResponseSuccess($survey_item, "Butir angket konseling berhasil didapatkan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data butir angket konseling", 'Internal Server Error !', 500);
        }
    }

    public function update(SurveyItemRequest $request, $id)
    {
        try {
            if (!SurveyItem::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah butir angket konseling", 'Butir angket konseling tidak ditemukan', 404);
            }
            $survey_item = SurveyItem::where('id', $id)->first();
            $survey_item->question = $request->question;
            $survey_item->requirement_formulation_id = $request->requirement_formulation_id;
            $survey_item->updated_at = round(microtime(true) * 1000);
            $survey_item->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah butir angket konseling", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah butir angket konseling". $e->getMessage(), 'Internal Server Error !', 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (!SurveyItem::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal menghapus butir angket konseling", 'Butir angket konseling tidak ditemukan', 404);
            }
            DB::beginTransaction();
            $survey_item = SurveyItem::where('id', $id)->first();
            $survey_item->delete();

            //reorder
            SurveyItem::where('order', '>', $survey_item->order)->decrement('order', 1);

            DB::commit();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus butir angket konseling", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseRepository->ResponseError("Gagal menghapus butir angket konseling", "Gagal menghapus butir angket konseling" . " " . $e->getMessage(), 500);
        }
    }
}
