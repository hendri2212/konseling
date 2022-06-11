<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ManageSoalRequest;
use App\Http\Resources\admin\ManageSoalResource;
use App\Models\Soal;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManageSoalController extends Controller
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
            $data = ManageSoalResource::collection(Soal::paginate(10));
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
    public function store(ManageSoalRequest $request)
    {
        try {
            $soal = new Soal();
            $soal->soal = $request->soal;
            $soal->rumusan_kebutuhan = $request->rumusan_kebutuhan;
            $soal->materi = $request->materi;
            $soal->tujuan_layanan = $request->tujuan_layanan;
            $soal->komponen_layanan = $request->komponen_layanan;
            $soal->strategi_layanan = $request->strategi_layanan;
            $soal->bidang_id = $request->bidang_id;
            $soal->kompetensi_id = $request->kompetensi_id;
            $soal->save();
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManageSoalRequest $request, $id)
    {
        try {
            // $is_duplicate = Soal::where([
            //     "soal" => $request->soal,
            //     "rumusan_kebutuhan" => $request->rumusan_kebutuhan,
            //     "materi" => $request->materi,
            //     "tujuan_layanan" => $request->tujuan_layanan,
            //     "komponen_layanan" => $request->komponen_layanan,
            //     "strategi_layanan" => $request->strategi_layanan,
            //     "bidang_id" => $request->bidang_id,
            //     "kompetensi_id" => $request->kompetensi_id
            // ])->first();
            // if ($is_duplicate) {
            //     if ($is_duplicate->id == $id) {
            //         return $this->responseRepository->ResponseError([
            //             'global' => 'Tidak merubah data apapun'
            //         ], "Tidak merubah data apapun", JsonResponse::HTTP_NOT_MODIFIED);
            //     }
            //     return $this->responseRepository->ResponseError([
            //         'global' => 'Kelas ini sudah pernah dibuat'
            //     ], "Kelas ini sudah pernah dibuat", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            // }
            $soal = Soal::find($id);
            $soal->soal = $request->soal;
            $soal->rumusan_kebutuhan = $request->rumusan_kebutuhan;
            $soal->materi = $request->materi;
            $soal->tujuan_layanan = $request->tujuan_layanan;
            $soal->komponen_layanan = $request->komponen_layanan;
            $soal->strategi_layanan = $request->strategi_layanan;
            $soal->bidang_id = $request->bidang_id;
            $soal->kompetensi_id = $request->kompetensi_id;
            $soal->save();
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
