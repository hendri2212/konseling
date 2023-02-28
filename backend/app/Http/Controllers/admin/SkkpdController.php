<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SkkpdRequest;
use App\Http\Resources\admin\SkkpdResource;
use App\Models\FieldComponent;
use App\Models\Skkpd;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkkpdController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request, $id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Gagal mendapatkan data SKKPD", 'FieldComponent layanan tidak ditemukan', 404);
            }
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_skkpd = Skkpd::where('field_component_id', $id)->count();
            $skkpd = Skkpd::where('field_component_id', $id)->paginate($max);
            $data = SkkpdResource::collection($skkpd);
            $pagination = [
                'max_page' => ceil($count_all_skkpd / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('skkpd.index', ['id' => $id, 'page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }

    public function store(SkkpdRequest $request, $id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("FieldComponent layanan tidak ditemukan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            $skkpd = new Skkpd();
            $skkpd->id = Str::uuid();
            $skkpd->name = $request->name;
            $skkpd->introduction = $request->introduction;
            $skkpd->accommodation = $request->accommodation;
            $skkpd->action = $request->action;
            $skkpd->field_component_id = $id;
            $skkpd->created_at = round(microtime(true) * 1000);
            $skkpd->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat skkpd", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat skkpd", 'Internal Server Error !', 500);
        }
    }

    public function show($id, $skkpd_id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("FieldComponent layanan tidak ditemukan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            $skkpd = Skkpd::find($skkpd_id);
            return $this->responseRepository->ResponseSuccess($skkpd, "SKKPD berhasil didapatkan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data SKKPD", 'Internal Server Error !', 500);
        }
    }

    public function update(SkkpdRequest $request, $id, $skkpd_id)
    {
        try {
            if (!Skkpd::where('id', $skkpd_id)->where('field_component_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'SKKPD tidak ditemukan', 404);
            }
            $skkpd = Skkpd::where('id', $skkpd_id)->where('field_component_id', $id)->first();
            $skkpd->name = $request->name;
            $skkpd->introduction = $request->introduction;
            $skkpd->accommodation = $request->accommodation;
            $skkpd->action = $request->action;
            $skkpd->updated_at = round(microtime(true) * 1000);
            $skkpd->save();

            return $this->responseRepository->ResponseSuccess(null, "Sukses mengubah SKKPD", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'Internal Server Error !', 500);
        }
    }

    public function destroy($id, $skkpd_id)
    {
        try {
            if (!Skkpd::where('id', $skkpd_id)->where('field_component_id', $id)->first()) {
                return $this->responseRepository->ResponseError("Gagal mengubah SKKPD", 'SKKPD tidak ditemukan', 404);
            }
            $skkpd = Skkpd::where('id', $skkpd_id)->where('field_component_id', $id)->first();
            $skkpd->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus SKKPD", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus SKKPD", "Gagal menghapus SKKPD" . " " . $e->getMessage(), 500);
        }
    }
}
