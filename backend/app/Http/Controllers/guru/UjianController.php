<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\guru\UjianRequest;
use App\Http\Resources\UjianResource;
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
        try {
            $ujian = Ujian::where('kelas_id', auth()->user()->kelas->id)->get();
            $data = UjianResource::collection($ujian);
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
}
