<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\FieldComponentRequest;
use App\Http\Resources\admin\FieldComponentResource;
use App\Models\FieldComponent;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FieldComponentLayananController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ( (int)$request->page >= 1 ? (int)$request->page : 1 )  : 1;
            $count_all_field_component = FieldComponent::count();
            $field_component = FieldComponent::paginate($max);
            $data = FieldComponentResource::collection($field_component);
            $pagination = [
                'max_page' => ceil($count_all_field_component / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('field_component.index', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(FieldComponentRequest $request)
    {
        try {
            $field_component = new FieldComponent();
            $field_component->id = Str::uuid();
            $field_component->name = $request->name;
            $field_component->created_at = round(microtime(true) * 1000);
            $field_component->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat data komponen bidang layanan", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data komponen bidang layanan", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
        try {
            $field_component_layanan = FieldComponent::find($id);
            return $this->responseRepository->ResponseSuccess($field_component_layanan, "FieldComponent layanan berhasil didapatkan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data komponen bidang layanan", 'Internal Server Error !', 500);
        }
    }

    public function update(FieldComponentRequest $request, $id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Error mengubah komponen bidang layanan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            $field_component = FieldComponent::find($id);
            $field_component->name = $request->name;
            $field_component->updated_at = round(microtime(true) * 1000);
            $field_component->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah data komponen bidang layanan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah data komponen bidang layanan", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (!FieldComponent::find($id)) {
                return $this->responseRepository->ResponseError("Error menghapus komponen bidang layanan", 'FieldComponent layanan tidak ditemukan', 404);
            }
            $field_component = FieldComponent::find($id);
            $field_component->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data komponen bidang layanan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data komponen bidang layanan", "Error menghapus data komponen bidang layanan" . " " . $e->getMessage() , 500);
        }
    }
}
