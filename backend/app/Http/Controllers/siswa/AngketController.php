<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Http\Resources\siswa\ListSoalResource;
use App\Http\Resources\siswa\AngketAttemptResource;
use App\Http\Resources\siswa\AngketResource as SiswaAngketResource;
use App\Models\Angket;
use App\Models\AngketAttempt;
use App\Models\Jawaban;
use App\Models\Soal;
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

    public function show($id)
    {
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

    public function status($id)
    {
        try {

            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $id)->where('siswa_id', auth()->id())->first();

            $data =  $attempt ? new AngketAttemptResource($attempt) : null;

            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }



    public function startattempt($id)
    {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $angket->id)->where('siswa_id', auth()->id())->first();
            if (!$attempt) {
                $attempt = new AngketAttempt();
                $attempt->id = Str::uuid();
                $attempt->angket_id = $id;
                $attempt->siswa_id = auth()->id();
                $attempt->save();
            }

            $data = new AngketAttemptResource($attempt);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function finishattempt($id)
    {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $angket->id)->where('state', 'inprogress')->where('siswa_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("ATTEMPT_NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt->state = "finished";
            $attempt->timefinish = date('Y-m-d H:i:s');
            $attempt->save();

            $data = new AngketAttemptResource($attempt);
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function lists($id)
    {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $angket->id)->where('siswa_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $lists = Soal::with(['jawaban' => function ($query) use ($attempt) {
                $query->select('soal_id')->where('angket_attempt_id', $attempt->id);
            }])->orderBy('order', 'asc')->get();
            return $this->responseRepository->ResponseSuccess(ListSoalResource::collection($lists), "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function attempt(Request $request, $id)
    {
        try {
            $page = $request->page ? $request->page : 0;
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $angket->id)->where('siswa_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $soal = Soal::orderBy('order', 'asc')->skip($page)->take(1)->first();
            $jawaban = Jawaban::where('angket_attempt_id', $attempt->id)->where('soal_id', $soal->id)->first();
            $meta = [
                'number' => $soal->order,
                'next_number' => $soal->order == Soal::max('order') ? null : $soal->order + 1,
                'previous_number' => $soal->order == Soal::min('order') ? null : $soal->order - 1
            ];

            $data = [
                'soal' => $soal,
                'jawaban' => $jawaban,
                'meta' => $meta
            ];
            return $this->responseRepository->ResponseSuccess($data, "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function answer(Request $request, $id, $id_soal)
    {
        try {
            $angket = Angket::where('kelas_id', auth()->user()->kelas_id)->where('id', $id)->first();
            if (!$angket) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $attempt = AngketAttempt::where('angket_id', $angket->id)->where('state', 'inprogress')->where('siswa_id', auth()->id())->first();
            if (!$attempt) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Sesi pengisian angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }
            $soal = Soal::find($id_soal);
            if (!$soal) {
                return $this->responseRepository->ResponseError("NOT_FOUND", "Butir angket tidak ditemukan!", JsonResponse::HTTP_NOT_FOUND);
            }

            $jawaban = Jawaban::where('angket_attempt_id', $attempt->id)->where('soal_id', $soal->id)->first();
            if (!$jawaban) {
                $jawaban = new Jawaban();
                $jawaban->id = Str::uuid();
                $jawaban->angket_attempt_id = $attempt->id;
                $jawaban->soal_id = $soal->id;
            }

            $jawaban->jawaban = $request->jawaban;
            $jawaban->save();

            return $this->responseRepository->ResponseSuccess("Berhasil", "Successfull", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
}
