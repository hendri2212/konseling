<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\EditSiswaRequest;
use App\Http\Requests\sekolah\SiswaRequest;
use App\Http\Resources\sekolah\SiswaResource as SekolahSiswaResource;
use Illuminate\Http\Request;
use App\Repositories\ResponseRepository;;

use App\Models\SiswaUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManageSiswaController extends Controller
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
            $count_all_guru = SiswaUser::where('sekolah_id', auth()->id())->count();
            $guru = SiswaUser::where('sekolah_id', auth()->id())->paginate($max);
            $data = SekolahSiswaResource::collection($guru);
            $pagination = [
                'max_page' => ceil($count_all_guru / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('guru.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function findByKelasId($id)
    {
        try {
            $siswa = SiswaUser::where([
                'sekolah_id' => auth()->id(),
                'kelas_id' => $id

            ])->paginate(10);
            $data = SekolahSiswaResource::collection($siswa);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(SiswaRequest $request)
    {
        try {
            $user = new SiswaUser();
            $user->id = Str::uuid();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->nama = $request->nama;
            $user->sekolah_id = auth()->id();
            $user->save();

            return $this->responseRepository->ResponseSuccess(new SekolahSiswaResource($user), "Success membuat data siswa", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data siswa", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(EditSiswaRequest $request, $id)
    {
        try {
            $user = SiswaUser::find($id);
            $user->username = $request->username;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->nama = $request->nama;
            $user->save();

            return $this->responseRepository->ResponseSuccess(new SekolahSiswaResource($user), "Success mengubah data siswa", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah data siswa", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = SiswaUser::find($id);
            $siswa->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data siswa", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data siswa", "Error menghapus data siswa" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
