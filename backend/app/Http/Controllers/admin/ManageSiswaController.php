<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\EditSiswaRequest;
use App\Http\Requests\admin\SiswaRequest;
use App\Http\Resources\sekolah\SiswaResource as SekolahSiswaResource;
use App\Http\Resources\sekolah\StudentResource;
use Illuminate\Http\Request;
use App\Repositories\ResponseRepository;;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManageSiswaController extends Controller
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
            if (isset($request->max)) {
                $max = $request->max;
            }
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_all_students = Student::where('school_id', auth()->id())->count();
            $students = Student::where('school_id', auth()->id());

            if (isset($request->punya_kelas)) {
                if ($request->punya_kelas == 'false') {
                    $students->where('class_id', null);
                } else {
                    $students->where('class_id', '!=', null);
                }
            }
            $data = StudentResource::collection($students->paginate($max));
            $pagination = [
                'max_page' => ceil($count_all_students / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('teachers.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getTrace());
        }
    }

    public function findByClassModelId($id)
    {
        try {
            $students = Student::where([
                'school_id' => auth()->id(),
                'class_id' => $id

            ])->paginate(10);
            $data = StudentResource::collection($students);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(SiswaRequest $request)
    {
        try {
            $user = new Student();
            $user->id = Str::uuid();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->school_id = auth()->id();
            $user->created_at = round(microtime(true) * 1000);
            $user->save();

            return $this->responseRepository->ResponseSuccess(new StudentResource($user), "Success membuat data students", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error membuat data students", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(EditSiswaRequest $request, $id)
    {
        try {
            $user = Student::find($id);
            $user->email = $request->email;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->name = $request->name;
            $user->updated_at = round(microtime(true) * 1000);
            $user->save();

            return $this->responseRepository->ResponseSuccess(new StudentResource($user), "Success mengubah data students", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengubah data students", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::find($id);
            $student->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data students", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data students", "Error menghapus data students" . " " . $e->getMessage(), 500);
        }
    }
}
