<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\KelasRequest;
use App\Http\Resources\KelasResource;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $kelas = Kelas::where('sekolah_id', auth()->id())->paginate(10);
            $data = KelasResource::collection($kelas);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        try {
            $is_duplicate = Kelas::where([
                'nama' => $request->nama,
                'sekolah_id' => auth()->id()
            ])->first();
            if ($is_duplicate) {
                return $this->responseRepository->ResponseError([
                    'global' => 'Kelas ini sudah pernah dibuat'
                ], "Kelas ini sudah pernah dibuat", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $kelas = new Kelas;
            $kelas->id = Str::uuid();
            $kelas->nama = $request->nama;
            $kelas->sekolah_id = auth()->id();
            $kelas->guru_id = $request->guru_id;
            $kelas->save();
            return $this->responseRepository->ResponseSuccess(null, "Success membuat kelas baru", JsonResponse::HTTP_CREATED);
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
            $data = new KelasResource(Kelas::where([
                'sekolah_id' => auth()->id(),
                'id' => $id
            ])->first());
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
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
    public function update(KelasRequest $request, $id)
    {
        try {
            $is_duplicate = Kelas::where([
                'nama' => $request->nama,
                'sekolah_id' => auth()->id(),
            ])->first();
            if ($is_duplicate) {
                if ($is_duplicate->id == $id) {
                    return $this->responseRepository->ResponseError([
                        'global' => 'Tidak merubah data apapun'
                    ], "Tidak merubah data apapun", JsonResponse::HTTP_NOT_MODIFIED);
                }
                return $this->responseRepository->ResponseError([
                    'global' => 'Kelas ini sudah pernah dibuat'
                ], "Kelas ini sudah pernah dibuat", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $kelas = Kelas::find($id);
            $kelas->nama = $request->nama;
            $kelas->guru_id = $request->guru_id;
            $kelas->save();
            return $this->responseRepository->ResponseSuccess(null, "Success memrubah data kelas", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null);
        }
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
}
