<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\EditGuruRequest;
use App\Http\Requests\admin\GuruRequest;
use App\Http\Resources\sekolah\TeacherResource;
use App\Models\Teacher;
use App\Repositories\ResponseRepository;
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

    public function index(Request $request)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_teachers = Teacher::where('school_id', auth()->id())->count();
            $teachers = Teacher::where('school_id', auth()->id())->paginate($max);
            $data = TeacherResource::collection($teachers);
            $pagination = [
                'max_page' => ceil($count_all_teachers / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('teachers.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(GuruRequest $request)
    {
        try {
            $user = new Teacher();
            $user->id = Str::uuid();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->school_id = auth()->id();
            $user->created_at = round(microtime(true) * 1000);
            $user->save();

            return $this->responseRepository->ResponseSuccess(new TeacherResource($user), "Success membuat data guru", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal membuat data guru", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
    }

    public function update(EditGuruRequest $request, $id)
    {
        try {
            $user = Teacher::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->updated_at = round(microtime(true) * 1000);
            $user->save();

            return $this->responseRepository->ResponseSuccess(new TeacherResource($user), "Sukses mengubah data guru", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah data guru", "Gagal mengubah data guru", 500);
        }
    }

    public function destroy($id)
    {
        try {
            $teacher = Teacher::find($id);
            $teacher->delete();
            return $this->responseRepository->ResponseSuccess(null, "Sukses menghapus data guru", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal menghapus data guru", "Gagal menghapus data guru", 500);
        }
    }
}
