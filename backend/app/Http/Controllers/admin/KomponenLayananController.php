<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\KomponenLayananRequest;
use App\Http\Resources\KomponenLayananResource;
use App\Models\KomponenLayanan;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KomponenLayananController extends Controller
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
            $count_all_komponen_layanan = KomponenLayanan::count();
            $komponen_layanan = KomponenLayanan::paginate($max);
            $data = KomponenLayananResource::collection($komponen_layanan);
            $pagination = [
                'max_page' => ceil($count_all_komponen_layanan / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('komponen-layanan.index', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(KomponenLayananRequest $request)
    {
        try {
            $komponen_layanan = new KomponenLayanan();
            $komponen_layanan->id = Str::uuid();
            $komponen_layanan->nama = $request->nama;
            $komponen_layanan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat komponen layanan", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat komponen layanan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $komponen_layanan = KomponenLayanan::find($id);
            return $this->responseRepository->ResponseSuccess($komponen_layanan, "Kelas berhasil didapatkan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data kelas", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(KomponenLayananRequest $request, $id)
    {
        try {
            $komponen_layanan = KomponenLayanan::find($id);
            $komponen_layanan->nama = $request->nama;
            $komponen_layanan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah komponen layanan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah komponen layanan", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $komponen_layanan = KomponenLayanan::find($id);
            $komponen_layanan->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus komponen layanan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus komponen layanan", "Error menghapus komponen layanan" . " " . $e->getMessage() , JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
