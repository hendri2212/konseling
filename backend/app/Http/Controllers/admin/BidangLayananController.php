<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BidangRequest;
use App\Http\Resources\BidangResource;
use App\Models\Bidang;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BidangLayananController extends Controller
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
            $page = isset($request->page) ? ( (int)$request->page >= 1 ? (int)$request->page : 1 )  : 1;
            $count_all_bidang = Bidang::count();
            $bidang = Bidang::paginate($max);
            $data = BidangResource::collection($bidang);
            $pagination = [
                'max_page' => ceil($count_all_bidang / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('bidang.index', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(BidangRequest $request)
    {
        try {
            $bidang = new Bidang();
            $bidang->id = Str::uuid();
            $bidang->nama = $request->nama;
            $bidang->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat data bidang layanan", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data bidang layanan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $bidang_layanan = Bidang::find($id);
            return $this->responseRepository->ResponseSuccess($bidang_layanan, "Bidang layanan berhasil didapatkan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data bidang layanan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(BidangRequest $request, $id)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Error mengubah bidang layanan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $bidang = Bidang::find($id);
            $bidang->nama = $request->nama;
            $bidang->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah data bidang layanan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah data bidang layanan", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            if (!Bidang::find($id)) {
                return $this->responseRepository->ResponseError("Error menghapus bidang layanan", 'Bidang layanan tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $bidang = Bidang::find($id);
            $bidang->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data bidang layanan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data bidang layanan", "Error menghapus data bidang layanan" . " " . $e->getMessage() , JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
