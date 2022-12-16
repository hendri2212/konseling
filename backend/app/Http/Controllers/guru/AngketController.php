<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\guru\AngketRequest;
use App\Http\Resources\OnlyAngketResource;
use App\Http\Resources\AngketResource;
use App\Models\Kelas;
use App\Models\Angket;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AngketController extends Controller
{

    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $kelas_id = Kelas::where('guru_id', auth()->id())->get()->pluck('id');
            $count_all_angket = Angket::whereIn('kelas_id', $kelas_id)->count();
            $angket = Angket::whereIn('kelas_id', $kelas_id)->paginate($max);
            $data = AngketResource::collection($angket);
            $pagination = [
                'max_page' => ceil($count_all_angket / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('angket.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
    
    public function store(AngketRequest $request)
    {
        try {
            $angket = new Angket;
            $angket->id = Str::uuid();
            $angket->nama = $request->nama;
            $angket->tanggal = now();
            $angket->kelas_id = auth()->user()->kelas->id;
            $angket->save();
            return $this->responseRepository->ResponseSuccess(null, "Success membuat angket baru", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas->id)->find($id);
            $data = new AngketResource($angket);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!Angket::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data angket", 'Angket tidak ditemukan', JsonResponse::HTTP_NOT_FOUND);
            }
            $angket = Angket::where('id', $id)->first();
            $angket->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus angket", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus angket", "Gagal menghapus angket" . " " . $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function open($id)
    {
        try {
            $angket = Angket::find($id);
            if ($angket) {
                $check_angket_open = Angket::where('kelas_id', $angket->kelas_id)->where('status', 'open')->exists();
                if (!$check_angket_open) {
                    $angket->status = "open";
                    $angket->save();
                    return $this->responseRepository->ResponseSuccess("Berhasil buka angket");
                }
                return $this->responseRepository->ResponseError("Ada angket dikelas ini yang sedang berlangsung!", "Unprocessable entity!", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->responseRepository->ResponseError("Angket tidak ditemukan!", "Data not found!", JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }

    public function close($id)
    {
        try {
            $angket = Angket::find($id);
            if ($angket) {
                $angket->status = "close";
                $angket->save();
                return $this->responseRepository->ResponseSuccess("Berhasil menutup angket");
            }
            return $this->responseRepository->ResponseError("Angket tidak ditemukan!", "Data not found!", JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }
}
