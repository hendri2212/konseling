<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\EditKelasRequest;
use App\Http\Requests\sekolah\KelasRequest;
use App\Http\Resources\sekolah\KelasResource as SekolahKelasResource;
use App\Models\Kelas;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{

    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request)
    {
        try {
            $max = 5;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_guru = Kelas::where('sekolah_id', auth()->id())->count();
            $guru = Kelas::with('guru')->where('sekolah_id', auth()->id())->paginate($max);
            $data = SekolahKelasResource::collection($guru);
            $pagination = [
                'max_page' => ceil($count_all_guru / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('kelas.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(KelasRequest $request)
    {
        try {
            $kelas = new Kelas();
            $kelas->id = Str::uuid();
            $kelas->nama = $request->nama;
            if (isset($request->guru_id)) {
                $kelas->guru_id = $request->guru_id;
            }
            $kelas->sekolah_id = auth()->id();
            $kelas->save();

            return $this->responseRepository->ResponseSuccess(null, "Berhasil membuat data kelas", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal membuat data kelas", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
    }

    public function update(EditKelasRequest $request, $id)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->nama = $request->nama;
            if (isset($request->guru_id)) {
                $kelas->guru_id = $request->guru_id;
            }
            $kelas->save();

            return $this->responseRepository->ResponseSuccess(null, "Berhasil mengubah data kelas", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah data kelas", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data kelas", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data kelas", "Error menghapus data kelas" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
