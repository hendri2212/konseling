<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RequirementFormulationRequest;
use App\Http\Resources\admin\RequirementFormulationResource;
use App\Models\FieldComponent;
use App\Models\RequirementFormulation;
use App\Models\Skkpd;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequirementFormulationController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request, $id, $skkpd_id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data rumusan kebutuhan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            if (!Skkpd::find($skkpd_id)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data rumusan kebutuhan", 'SKKPD tidak ditemukan', 404);
            }
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_rumusan_kebutuhan = RequirementFormulation::where('skkpd_id', $skkpd_id)->count();
            $rumusan_kebutuhan = RequirementFormulation::with('topic')->where('skkpd_id', $skkpd_id)->paginate($max);
            $data = RequirementFormulationResource::collection($rumusan_kebutuhan);
            $pagination = [
                'max_page' => ceil($count_all_rumusan_kebutuhan / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('requirements_formulation.index', ['id' => $id, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $search = $request->search;
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_requirements_formulation = RequirementFormulation::count();
            $requirements_formulation = RequirementFormulation::with(['skkpd.fieldComponent'])->where('name', 'like', '%'.$search.'%')->paginate($max);
            $data = RequirementFormulationResource::collection($requirements_formulation);
            $pagination = [
                'max_page' => ceil($count_all_requirements_formulation / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('requirements_formulation.search', ['search' => $request->search, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(RequirementFormulationRequest $request, $id, $skkpd_id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menambah data rumusan kebutuhan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            if (!Skkpd::find($skkpd_id)) {
                return $this->responseRepository->ResponseError("Gagal menambah data rumusan kebutuhan", 'SKKPD tidak ditemukan', 404);
            }
            $rumusan_kebutuhan = new RequirementFormulation();
            $rumusan_kebutuhan->id = Str::uuid();
            $rumusan_kebutuhan->name = $request->name;
            $rumusan_kebutuhan->service_objective = $request->service_objective;
            $rumusan_kebutuhan->topic_id = $request->topic_id;
            $rumusan_kebutuhan->skkpd_id = $skkpd_id;
            $rumusan_kebutuhan->created_at = round(microtime(true) * 1000);
            $rumusan_kebutuhan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat rumusan kebutuhan", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat runusan kebutuhan", 'Internal Server Error !', 500);
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $materi = Topic::find($id);
    //         return $this->responseRepository->ResponseSuccess($materi, "Topic berhasil didapatkan", 200);
    //     } catch (\Exception $e) {
    //         return $this->responseRepository->ResponseError("Gagal mendapatkan data materi", 'Internal Server Error !', 500);
    //     }
    // }

    public function update(RequirementFormulationRequest $request, $id, $skkpd_id, $requirement_formulation_id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mengubah data rumusan kebutuhan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            if (!Skkpd::find($skkpd_id)) {
                return $this->responseRepository->ResponseError("Gagal mengubah data rumusan kebutuhan", 'SKKPD tidak ditemukan', 404);
            }
            if (!RequirementFormulation::where('id', $requirement_formulation_id)->where('skkpd_id', $skkpd_id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah rumusan kebutuhan", 'Rumusan kebutuhan tidak ditemukan', 404);
            }
            $rumusan_kebutuhan = RequirementFormulation::where('id', $requirement_formulation_id)->where('skkpd_id', $skkpd_id)->first();
            $rumusan_kebutuhan->name = $request->name;
            $rumusan_kebutuhan->tujuan_layanan = $request->tujuan_layanan;
            $rumusan_kebutuhan->topic_id = $request->topic_id;
            $rumusan_kebutuhan->updated_at = round(microtime(true) * 1000);
            $rumusan_kebutuhan->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah rumusan kebutuhan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah rumusan kebutuhan", 'Internal Server Error !', 500);
        }
    }

    public function destroy($id, $skkpd_id, $requirement_formulation_id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data rumusan kebutuhan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            if (!Skkpd::find($skkpd_id)) {
                return $this->responseRepository->ResponseError("Gagal menghapus data rumusan kebutuhan", 'SKKPD tidak ditemukan', 404);
            }
            if (!RequirementFormulation::where('id', $requirement_formulation_id)->where('skkpd_id', $skkpd_id)->first()) {
                return $this->responseRepository->ResponseError("Gagal menghapus rumusan kebutuhan", 'Rumusan kebutuhan tidak ditemukan', 404);
            }
            $rumusan_kebutuhan = RequirementFormulation::where('id', $requirement_formulation_id)->where('skkpd_id', $skkpd_id)->first();
            $rumusan_kebutuhan->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus rumusan kebutuhan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus rumusan kebutuhan", "Gagal menghapus rumusan kebutuhan" . " " . $e->getMessage(), 500);
        }
    }
}
