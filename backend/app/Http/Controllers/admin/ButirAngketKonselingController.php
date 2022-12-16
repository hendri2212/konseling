<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BidangRequest;
use App\Http\Requests\ButirAngketKonselingRequest;
// use App\Http\Resources\BidangResource;
use App\Http\Resources\ButirAngketKonselingResource;
use App\Models\Bidang;
use App\Models\Soal;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ButirAngketKonselingController extends Controller
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
            $count_all_soal = Soal::count();
            $soal = Soal::with(['rumusan_kebutuhan.skkpd.bidang', 'rumusan_kebutuhan.materi.komponen_layanan'])->orderBy('order')->paginate($max);
            $data = ButirAngketKonselingResource::collection($soal);
            $pagination = [
                'max_page' => ceil($count_all_soal / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('butir-angket-konseling.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(ButirAngketKonselingRequest $request)
    {
        try {
            $butir_angket_konseling = new Soal();
            $butir_angket_konseling->id = Str::uuid();
            $butir_angket_konseling->soal = $request->soal;
            $butir_angket_konseling->rumusan_kebutuhan_id = $request->rumusan_kebutuhan_id;
            $last = Soal::latest('order')->first()->order;
            $butir_angket_konseling->order = $last+1;
            $butir_angket_konseling->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat butir angket konseling", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat butir angket konseling", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            if (!Soal::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan butir angket konseling", 'Butir angket konseling tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $butir_angket_konseling = Soal::find($id);
            return $this->responseRepository->ResponseSuccess($butir_angket_konseling, "Butir angket konseling berhasil didapatkan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data butir angket konseling", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ButirAngketKonselingRequest $request, $id)
    {
        try {
            if (!Soal::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah butir angket konseling", 'Butir angket konseling tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $butir_angket_konseling = Soal::where('id', $id)->first();
            $butir_angket_konseling->soal = $request->soal;
            $butir_angket_konseling->rumusan_kebutuhan_id = $request->rumusan_kebutuhan_id;
            $butir_angket_konseling->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah butir angket konseling", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah butir angket konseling". $e->getMessage(), 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            if (!Soal::where('id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal menghapus butir angket konseling", 'Butir angket konseling tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            DB::beginTransaction();
            $butir_angket_konseling = Soal::where('id', $id)->first();
            $butir_angket_konseling->delete();

            //reorder
            Soal::where('order', '>', $butir_angket_konseling->order)->decrement('order', 1);

            DB::commit();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus butir angket konseling", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseRepository->ResponseError("Gagal menghapus butir angket konseling", "Gagal menghapus butir angket konseling" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
