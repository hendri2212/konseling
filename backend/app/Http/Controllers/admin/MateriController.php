<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriRequest;
use App\Http\Resources\MateriResource;
use App\Models\KomponenLayanan;
use App\Models\Materi;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
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
            $count_all_materi = Materi::count();
            $materi = Materi::paginate($max);
            $data = MateriResource::collection($materi);
            $pagination = [
                'max_page' => ceil($count_all_materi / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('materi.all', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function index(Request $request, $id)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ( (int)$request->page >= 1 ? (int)$request->page : 1 )  : 1;
            $count_all_materi = Materi::where('komponen_layanan_id', $id)->count();
            $materi = Materi::where('komponen_layanan_id', $id)->paginate($max);
            $data = MateriResource::collection($materi);
            $pagination = [
                'max_page' => ceil($count_all_materi / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('materi.index', ['id' => $id, 'page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(MateriRequest $request, $id)
    {
        try {
            if (!KomponenLayanan::find($id)) {
                return $this->responseRepository->ResponseError("Error membuat materi", 'Komponen layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $materi = new Materi();
            $materi->id = Str::uuid();
            $materi->nama = $request->nama;
            $materi->komponen_layanan_id = $id;
            $materi->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat materi", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat materi", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $materi = Materi::find($id);
    //         return $this->responseRepository->ResponseSuccess($materi, "Materi berhasil didapatkan", JsonResponse::HTTP_OK);
    //     } catch (\Exception $e) {
    //         return $this->responseRepository->ResponseError("Gagal mendapatkan data materi", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    public function update(MateriRequest $request, $id, $id_materi)
    {
        try {
            if (!Materi::where('id', $id_materi)->where('komponen_layanan_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Error mengubah materi", 'Materi tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $materi = Materi::where('id', $id_materi)->where('komponen_layanan_id', $id)->first();
            $materi->nama = $request->nama;
            $materi->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah materi", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah materi", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id, $id_materi)
    {
        try {
            if (!Materi::where('id', $id_materi)->where('komponen_layanan_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Error mengubah materi", 'Materi tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $materi = Materi::where('id', $id_materi)->where('komponen_layanan_id', $id)->first();
            $materi->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus materi", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus materi", "Error menghapus materi" . " " . $e->getMessage() , JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
