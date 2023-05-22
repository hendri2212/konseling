<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Models\ClassModel;
use App\Models\Survey;
use App\Models\SurveyItem;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
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
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $class_id = ClassModel::where('teacher_id', auth()->id())->get()->pluck('id');
            $count_all_angket = Survey::whereIn('class_id', $class_id)->count();
            $angket = Survey::whereIn('class_id', $class_id)->paginate($max);
            $data = SurveyResource::collection($angket);
            $pagination = [
                'max_page' => ceil($count_all_angket / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('surveys.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(SurveyRequest $request)
    {
        try {
            $angket = new Survey;
            $angket->id = Str::uuid();
            $angket->name = $request->name;
            $angket->number_of_survey_items = SurveyItem::count();
            $angket->class_name = auth()->user()->class->name;
            $angket->class_id = auth()->user()->class->id;
            $angket->school_id = auth()->user()->school->id;
            $angket->created_at = round(microtime(true) * 1000);
            $angket->save();
            return $this->responseRepository->ResponseSuccess(null, "Success membuat angket baru", 201);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, "Gagal menambah angket", 500);
        }
    }

    public function show($id)
    {
        try {
            $angket = Survey::where('class_id', auth()->user()->kelas->id)->find($id);
            $data = new SurveyResource($angket);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function destroy($id)
    {
        try {
            if (!Survey::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data angket", 'Survey tidak ditemukan', 404);
            }
            $angket = Survey::where('id', $id)->first();
            $angket->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus angket", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus angket", "Gagal menghapus angket" . " " . $e->getMessage(), 500);
        }
    }

    public function open($id)
    {
        try {
            $angket = Survey::find($id);
            if ($angket) {
                $check_angket_open = Survey::whereClassId($angket->class_id)->whereOpen()->exists();
                if (!$check_angket_open) {
                    $angket->status = "open";
                    $angket->updated_at = round(microtime(true) * 1000);
                    $angket->save();
                    return $this->responseRepository->ResponseSuccess("Berhasil buka angket");
                }
                return $this->responseRepository->ResponseError("Ada angket dikelas ini yang sedang berlangsung!", "Unprocessable entity!", 422);
            }
            return $this->responseRepository->ResponseError("Survey tidak ditemukan!", "Data not found!", 404);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }

    public function close($id)
    {
        try {
            $angket = Survey::find($id);
            if ($angket) {
                $angket->status = "close";
                $angket->updated_at = round(microtime(true) * 1000);
                $angket->save();
                return $this->responseRepository->ResponseSuccess("Berhasil menutup angket");
            }
            return $this->responseRepository->ResponseError("Survey tidak ditemukan!", "Data not found!", 404);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }
}
