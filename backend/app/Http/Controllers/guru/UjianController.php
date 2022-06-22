<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\guru\UjianRequest;
use App\Http\Resources\OnlyUjianResource;
use App\Http\Resources\UjianResource;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UjianController extends Controller
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
    public function index()
    {
        // try {
            $kelas_id = Kelas::where('guru_id', auth()->id())->get()->pluck('id');
            $ujian = Ujian::whereIn('kelas_id', $kelas_id)->get();
            $data = UjianResource::collection($ujian);
            return $this->responseRepository->ResponseSuccess($data);
        // } catch (\Exception $e) {
        //     return $this->responseRepository->ResponseError(null);
        // }
    }

    public function setiapKelas($id)
    {
        // try {
            $kelas_id = [$id];
            $ujian = Ujian::whereIn('kelas_id', $kelas_id)->get();
            $data = OnlyUjianResource::collection($ujian);
            return $this->responseRepository->ResponseSuccess($data);
        // } catch (\Exception $e) {
        //     return $this->responseRepository->ResponseError(null);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UjianRequest $request)
    {
        try {
            $ujian = new Ujian;
            $ujian->id = Str::uuid();
            $ujian->nama = $request->nama;
            $ujian->tanggal = now();
            $ujian->kelas_id = auth()->user()->kelas->id;
            $ujian->save();
            return $this->responseRepository->ResponseSuccess(null, "Success membuat ujian baru", JsonResponse::HTTP_CREATED);
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
            $ujian = Ujian::where('kelas_id', auth()->user()->kelas->id)->find($id);
            $data = new UjianResource($ujian);
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
        //
    }

    public function open($id){
        try {
            $ujian = Ujian::find($id);
            if($ujian){
                $check_ujian_open = Ujian::where('kelas_id', $ujian->kelas_id)->where('status', 'open')->exists();
                if(!$check_ujian_open){
                    $ujian->status = "open";
                    $ujian->save();
                    return $this->responseRepository->ResponseSuccess("Berhasil buka ujian");
                }
                return $this->responseRepository->ResponseError("Ada ujian dikelas ini yang sedang berlangsung!", "Unprocessable entity!", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->responseRepository->ResponseError("Ujian tidak ditemukan!", "Data not found!", JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }

    public function close($id){
        try {
            $ujian = Ujian::find($id);
            if($ujian){
                $ujian->status = "close";
                $ujian->save();
                return $this->responseRepository->ResponseSuccess("Berhasil menutup ujian");
            }
            return $this->responseRepository->ResponseError("Ujian tidak ditemukan!", "Data not found!", JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError("Internal server error!");
        }
    }
}
