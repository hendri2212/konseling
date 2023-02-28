<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TopicRequest;
use App\Http\Resources\admin\TopicResource;
use App\Models\ServiceComponent;
use App\Models\Topic;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function all(Request $request) {
        try {
            $max = 10;
            $page = isset($request->page) ? ( (int)$request->page >= 1 ? (int)$request->page : 1 )  : 1;
            $count_all_materi = Topic::count();
            $materi = Topic::paginate($max);
            $data = TopicResource::collection($materi);
            $pagination = [
                'max_page' => ceil($count_all_materi / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('topics.all', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function index(Request $request, $id)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ( (int)$request->page >= 1 ? (int)$request->page : 1 )  : 1;
            $count_all_materi = Topic::where('service_component_id', $id)->count();
            $materi = Topic::where('service_component_id', $id)->paginate($max);
            $data = TopicResource::collection($materi);
            $pagination = [
                'max_page' => ceil($count_all_materi / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('topics.index', ['id' => $id, 'page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(TopicRequest $request, $id)
    {
        try {
            if (!ServiceComponent::find($id)) {
                return $this->responseRepository->ResponseError("Error membuat materi", 'Komponen layanan tidak ditemukan', 404);
            }
            $materi = new Topic();
            $materi->id = Str::uuid();
            $materi->name = $request->name;
            $materi->service_component_id = $id;
            $materi->created_at = round(microtime(true) * 1000);
            $materi->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat materi", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat materi", 'Internal Server Error !', 500);
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $materi = Topic::find($id);
    //         return $this->responseRepository->ResponseSuccess($materi, "Topic berhasil didapatkan", 200);
    //     } catch (\Exception $e) {
    //         return $this->responseRepository->ResponseError("Gagal mendapatkan data materi", 'Internal Server Error !', 500);
    //     }
    // }

    public function update(TopicRequest $request, $id, $topic_id)
    {
        try {
            if (!Topic::where('id', $topic_id)->where('service_component_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Error mengubah materi", 'Topic tidak ditemukan', 404);
            }
            $materi = Topic::where('id', $topic_id)->where('service_component_id', $id)->first();
            $materi->name = $request->name;
            $materi->updated_at = round(microtime(true) * 1000);
            $materi->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah materi", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah materi", 'Internal Server Error !', 500);
        }
    }

    public function destroy($id, $topic_id)
    {
        try {
            if (!Topic::where('id', $topic_id)->where('service_component_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Error mengubah materi", 'Topic tidak ditemukan', 404);
            }
            $materi = Topic::where('id', $topic_id)->where('service_component_id', $id)->first();
            $materi->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus materi", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus materi", "Error menghapus materi" . " " . $e->getMessage() , 500);
        }
    }
}
