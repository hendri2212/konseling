<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListSoalResource;
use App\Http\Resources\SoalResource;
use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\Ujian;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SoalController extends Controller
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
    public function listSoal()
    {
        try {
            $siswa_id = auth()->id();
            $kelas_id = auth()->user()->kelas_id;
            $ujian = Ujian::where('kelas_id', $kelas_id)->where('status', 'open')->first();
            if($ujian){
                $soal = Soal::with(['jawaban' => function($q) use($siswa_id, $ujian) {
                    return $q->where('siswa_id', $siswa_id)->where('ujian_id', $ujian->id);
                    
                }])->get()->map(function($user, $key) {
                    $user->num = $key+1;
                    return $user;
                });
                $data = ListSoalResource::collection($soal);
                return $this->responseRepository->ResponseSuccess($data);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    public function index()
    {
        try {
            $siswa_id = auth()->id();
            $kelas_id = auth()->user()->kelas_id;
            $ujian = Ujian::where('kelas_id', $kelas_id)->where('status', 'open')->first();
            if($ujian){
                $soal = Soal::with(['jawaban' => function($q) use($siswa_id, $ujian) {
                    return $q->where('siswa_id', $siswa_id)->where('ujian_id', $ujian->id);
                    
                }])->paginate(1);
                $data = SoalResource::collection($soal);
                return $this->responseRepository->ResponseSuccess($data);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    public function jawab(Request $request)
    {
        // return "tes";
        $validator = Validator::make($request->all(), [
            'id' => "required",
            'jawaban' => "required",
        ]);
        if($validator->fails()){
            return $this->responseRepository->ResponseError("Parameter not found!", "Paramter not found!", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $siswa_id = auth()->id();
        $kelas_id = auth()->user()->kelas_id;
        try {
            $ujian = Ujian::where('kelas_id', $kelas_id)->where('status', 'open')->first();
            if($ujian){
                $check_jawaban = Jawaban::where('siswa_id', $siswa_id)
                ->where('ujian_id', $ujian->id)
                ->where('soal_id', $request->id)->first();
                if($check_jawaban){
                    $check_jawaban->jawaban = $request->jawaban;
                    $check_jawaban->save();
                }else{
                    $jawaban = new Jawaban;
                    $jawaban->id = Str::uuid();
                    $jawaban->jawaban = $request->jawaban;
                    $jawaban->siswa_id = $siswa_id;
                    $jawaban->ujian_id = $ujian->id;
                    $jawaban->soal_id = $request->id;
                    $jawaban->save();
                }
                return $this->responseRepository->ResponseSuccess([
                    'Berhasil set jawaban'
                ]);
            }
            return $this->responseRepository->ResponseSuccess(null);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
