<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ServiceComponentRequest;
use App\Http\Resources\admin\ServiceComponentResource;
use App\Models\ServiceComponent;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceComponentController extends Controller
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
            $count_all_komponen_layanan = ServiceComponent::count();
            $komponen_layanan = ServiceComponent::paginate($max);
            $data = ServiceComponentResource::collection($komponen_layanan);
            $pagination = [
                'max_page' => ceil($count_all_komponen_layanan / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('service_components.index', ['page' => $page+1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(ServiceComponentRequest $request)
    {
        try {
            $komponen_layanan = new ServiceComponent();
            $komponen_layanan->id = Str::uuid();
            $komponen_layanan->name = $request->name;
            $komponen_layanan->created_at = round(microtime(true) * 1000);
            $komponen_layanan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat komponen layanan", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat komponen layanan", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
        try {
            $komponen_layanan = ServiceComponent::find($id);
            return $this->responseRepository->ResponseSuccess($komponen_layanan, "ClassModel berhasil didapatkan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data kelas", 'Internal Server Error !', 500);
        }
    }

    public function update(ServiceComponentRequest $request, $id)
    {
        try {
            $komponen_layanan = ServiceComponent::find($id);
            $komponen_layanan->name = $request->name;
            $komponen_layanan->updated_at = round(microtime(true) * 1000);
            $komponen_layanan->save();

            return $this->responseRepository->ResponseSuccess(null, "Success mengubah komponen layanan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah komponen layanan", 'Internal Server Error !', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $komponen_layanan = ServiceComponent::find($id);
            $komponen_layanan->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus komponen layanan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus komponen layanan", "Error menghapus komponen layanan" . " " . $e->getMessage() , 500);
        }
    }
}
