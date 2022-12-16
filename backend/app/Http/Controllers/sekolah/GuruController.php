<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\EditGuruRequest;
use App\Http\Requests\sekolah\GuruRequest;
use App\Http\Resources\sekolah\GuruResource;
use App\Models\GuruUser;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruController extends Controller
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
            $count_all_guru = GuruUser::where('sekolah_id', auth()->id())->count();
            $guru = GuruUser::where('sekolah_id', auth()->id())->paginate($max);
            $data = GuruResource::collection($guru);
            $pagination = [
                'max_page' => ceil($count_all_guru / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('guru.index', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(GuruRequest $request)
    {
        try {
            $user = new GuruUser();
            $user->id = Str::uuid();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->sekolah_id = auth()->id();
            $user->save();

            return $this->responseRepository->ResponseSuccess(new GuruResource($user), "Success membuat data guru", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data guru", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
    }

    public function update(EditGuruRequest $request, $id)
    {
        try {
            $user = GuruUser::find($id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return $this->responseRepository->ResponseSuccess(new GuruResource($user), "Success mengubah data guru", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah data guru", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $guru = GuruUser::find($id);
            $guru->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data guru", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data guru", "Error menghapus data guru" . " " . $e->getMessage() , JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
