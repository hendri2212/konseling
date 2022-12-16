<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RumusanKebutuhanRequest;
use App\Http\Requests\SkkpdRequest;
use App\Http\Resources\RumusanKebutuhanResource;
use App\Http\Resources\SkkpdResource;
use App\Models\Bidang;
use App\Models\RumusanKebutuhan;
use App\Models\Skkpd;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RumusanKebutuhanController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request, $id, $id_skkpd)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data rumusan kebutuhan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!Skkpd::find($id_skkpd)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data rumusan kebutuhan", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_rumusan_kebutuhan = RumusanKebutuhan::where('skkpd_id', $id_skkpd)->count();
            $rumusan_kebutuhan = RumusanKebutuhan::with('materi')->where('skkpd_id', $id_skkpd)->paginate($max);
            $data = RumusanKebutuhanResource::collection($rumusan_kebutuhan);
            $pagination = [
                'max_page' => ceil($count_all_rumusan_kebutuhan / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('rumusan_kebutuhan.index', ['id' => $id, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $search = $request->search;
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_rumusan_kebutuhan = RumusanKebutuhan::count();
            $rumusan_kebutuhan = RumusanKebutuhan::with(['skkpd.bidang'])->where('nama', 'like', '%'.$search.'%')->paginate($max);
            $data = RumusanKebutuhanResource::collection($rumusan_kebutuhan);
            $pagination = [
                'max_page' => ceil($count_all_rumusan_kebutuhan / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('rumusan_kebutuhan.search', ['search' => $request->search, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(RumusanKebutuhanRequest $request, $id, $id_skkpd)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menambah data rumusan kebutuhan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!Skkpd::find($id_skkpd)) {
                return $this->responseRepository->ResponseError("Gagal menambah data rumusan kebutuhan", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $rumusan_kebutuhan = new RumusanKebutuhan();
            $rumusan_kebutuhan->id = Str::uuid();
            $rumusan_kebutuhan->nama = $request->nama;
            $rumusan_kebutuhan->tujuan_layanan = $request->tujuan_layanan;
            $rumusan_kebutuhan->materi_id = $request->materi_id;
            $rumusan_kebutuhan->skkpd_id = $id_skkpd;
            $rumusan_kebutuhan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat rumusan kebutuhan", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat runusan kebutuhan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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

    public function update(RumusanKebutuhanRequest $request, $id, $id_skkpd, $id_rumusan_kebutuhan)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mengubah data rumusan kebutuhan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!Skkpd::find($id_skkpd)) {
                return $this->responseRepository->ResponseError("Gagal mengubah data rumusan kebutuhan", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!RumusanKebutuhan::where('id', $id_rumusan_kebutuhan)->where('skkpd_id', $id_skkpd)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah rumusan kebutuhan", 'Rumusan kebutuhan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $rumusan_kebutuhan = RumusanKebutuhan::where('id', $id_rumusan_kebutuhan)->where('skkpd_id', $id_skkpd)->first();
            $rumusan_kebutuhan->nama = $request->nama;
            $rumusan_kebutuhan->tujuan_layanan = $request->tujuan_layanan;
            $rumusan_kebutuhan->materi_id = $request->materi_id;
            $rumusan_kebutuhan->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah rumusan kebutuhan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah rumusan kebutuhan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id, $id_skkpd, $id_rumusan_kebutuhan)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data rumusan kebutuhan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!Skkpd::find($id_skkpd)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data rumusan kebutuhan", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            if (!RumusanKebutuhan::where('id', $id_rumusan_kebutuhan)->where('skkpd_id', $id_skkpd)->first()) {
                return $this->responseRepository->ResponseError("Gagal menghapus rumusan kebutuhan", 'Rumusan kebutuhan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $rumusan_kebutuhan = RumusanKebutuhan::where('id', $id_rumusan_kebutuhan)->where('skkpd_id', $id_skkpd)->first();
            $rumusan_kebutuhan->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus rumusan kebutuhan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus rumusan kebutuhan", "Gagal menghapus rumusan kebutuhan" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
