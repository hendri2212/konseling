<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\AssignSiswaRequest;
use App\Http\Requests\sekolah\EditKelasRequest;
use App\Http\Requests\sekolah\KelasRequest;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use App\Models\SiswaUser;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            if (Auth::guard('sekolah')->check()) {
                $count_all_kelas = Kelas::where('sekolah_id', auth()->id())->count();
                $kelas = Kelas::with('guru')->withCount('siswa')->where('sekolah_id', auth()->id())->paginate($max);
            } else {
                $count_all_kelas = Kelas::where('guru_id', auth()->id())->count();
                $kelas = Kelas::where('guru_id', auth()->id())->paginate($max);
            }
            $data = KelasResource::collection($kelas);
            $pagination = [
                'max_page' => ceil($count_all_kelas / $max),
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
        try {
            $kelas = Kelas::with('siswa')->find($id);
            return $this->responseRepository->ResponseSuccess($kelas, "Kelas berhasil didapatkan", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data kelas", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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

    public function assign(AssignSiswaRequest $request, $id)
    {
        try {
            $kelas = Kelas::find($id);
            if (!$kelas) {
                return $this->responseRepository->ResponseError("Kelas tidak ditemukan", "Kelas tidak ditemukan", JsonResponse::HTTP_NOT_FOUND);
            }
            for ($i = 0; $i < count($request->siswa_id); $i++) {
                $siswa = SiswaUser::find($request->siswa_id[$i]);
                if (!$siswa->kelas_id) {
                    $siswa->kelas_id = $id;
                    $siswa->save();
                }
            }
            return $this->responseRepository->ResponseSuccess(null, "Berhasil assign siswa ke dalam kelas", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error assign siswa ke dalam kelas", "Error assign siswa ke dalam kelas" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function hapus(AssignSiswaRequest $request, $id)
    {
        try {
            $kelas = Kelas::find($id);
            if (!$kelas) {
                return $this->responseRepository->ResponseError("Kelas tidak ditemukan", "Kelas tidak ditemukan", JsonResponse::HTTP_NOT_FOUND);
            }
            for ($i = 0; $i < count($request->siswa_id); $i++) {
                $siswa = SiswaUser::where('kelas_id', $id)->where('id', $request->siswa_id[$i])->first();
                $siswa->kelas_id = null;
                $siswa->save();
            }
            return $this->responseRepository->ResponseSuccess(null, "Berhasil mengeluarkan siswa dari kelas", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengeluarkan siswa dari kelas", "Error mengeluarkan siswa dari kelas" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
