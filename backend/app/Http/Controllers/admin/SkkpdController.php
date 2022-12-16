<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkkpdRequest;
use App\Http\Resources\SkkpdResource;
use App\Models\Bidang;
use App\Models\Skkpd;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkkpdController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request, $id)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data SKKPD", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_skkpd = Skkpd::where('bidang_id', $id)->count();
            $skkpd = Skkpd::where('bidang_id', $id)->paginate($max);
            $data = SkkpdResource::collection($skkpd);
            $pagination = [
                'max_page' => ceil($count_all_skkpd / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('skkpd.index', ['id' => $id, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(SkkpdRequest $request, $id)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Bidang layanan tidak ditemukan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $skkpd = new Skkpd();
            $skkpd->id = Str::uuid();
            $skkpd->nama = $request->nama;
            $skkpd->pengenalan = $request->pengenalan;
            $skkpd->akomodasi = $request->akomodasi;
            $skkpd->tindakan = $request->tindakan;
            $skkpd->bidang_id = $id;
            $skkpd->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat skkpd", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat skkpd", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id, $id_skkpd)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Bidang layanan tidak ditemukan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $skkpd = Skkpd::find($id_skkpd);
            return $this->responseRepository->ResponseSuccess($skkpd, "SKKPD berhasil didapatkan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data SKKPD", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(SkkpdRequest $request, $id, $id_skkpd)
    {
        try {
            if (!Skkpd::where('id', $id_skkpd)->where('bidang_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $skkpd = Skkpd::where('id', $id_skkpd)->where('bidang_id', $id)->first();
            $skkpd->nama = $request->nama;
            $skkpd->pengenalan = $request->pengenalan;
            $skkpd->akomodasi = $request->akomodasi;
            $skkpd->tindakan = $request->tindakan;
            $skkpd->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah SKKPD", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id, $id_skkpd)
    {
        try {
            if (!Skkpd::where('id', $id_skkpd)->where('bidang_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'SKKPD tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $skkpd = Skkpd::where('id', $id_skkpd)->where('bidang_id', $id)->first();
            $skkpd->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus SKKPD", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus SKKPD", "Gagal menghapus SKKPD" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
