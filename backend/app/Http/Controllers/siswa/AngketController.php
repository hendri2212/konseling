<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\siswa\AngketResource as SiswaAngketResource;
use App\Models\Angket;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AngketController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }
    public function index(Request $request)
    {
        try {
            // $max = 10;
            // $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            // $kelas_id = Kelas::where('guru_id', auth()->id())->get()->pluck('id');
            // $count_all_angket = Angket::whereIn('kelas_id', $kelas_id)->count();
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->get();
            $data = SiswaAngketResource::collection($angket);
            // $pagination = [
            //     'max_page' => ceil($count_all_angket / $max),
            //     'next' => null
            // ];
            // if ($page < $pagination['max_page']) {
            //     $pagination['next'] = route('angket.index', ['page' => $page + 1]);
            // }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function show(Request $request, $id) {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND); 
            }

            $data = new SiswaAngketResource($angket);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
}
