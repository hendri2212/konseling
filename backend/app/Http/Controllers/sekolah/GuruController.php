<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\GuruRequest;
use App\Http\Resources\sekolah\GuruResource;
use App\Models\GuruUser;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index()
    {
        try {
            $guru = GuruUser::where('sekolah_id', auth()->id())->paginate(10);
            $data = GuruResource::collection($guru);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(GuruRequest $request)
    {
        try {

            $user = GuruUser::where([
                'nip' => $request->nip,
                'sekolah_id' => auth()->id()
            ])->exists();
            if($user){
                return $this->responseRepository->ResponseError("NIP ini telah digunakan guru lain", "NIP ini telah digunakan guru lain", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $user = new GuruUser();
            $user->id = Str::uuid();
            $user->nama = $request->nama;
            $user->nip = $request->nip;
            $user->password = Hash::make($request->password);
            $user->sekolah_id = auth()->id();
            $user->save();

            return $this->responseRepository->ResponseSuccess(null, "Success membuat data guru", JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data guru", 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
