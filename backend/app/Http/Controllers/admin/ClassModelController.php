<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AssignSiswaRequest;
use App\Http\Requests\admin\EditClassRequest;
use App\Http\Requests\admin\ClassRequest;
use App\Http\Resources\ClassResource;
use App\Models\ClassModel;
use App\Models\Student;
use App\Repositories\ResponseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassModelController extends Controller
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
            if (Auth::guard('schools')->check()) {
                $count_all_kelas = ClassModel::where('school_id', auth()->id())->count();
                $kelas = ClassModel::with('teacher')->withCount('students')->where('school_id', auth()->id())->paginate($max);
            } else {
                $count_all_kelas = ClassModel::where('teacher_id', auth()->id())->count();
                $kelas = ClassModel::where('teacher_id', auth()->id())->paginate($max);
            }
            $data = ClassResource::collection($kelas);
            $pagination = [
                'max_page' => ceil($count_all_kelas / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('classes.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(ClassRequest $request)
    {
        try {
            $kelas = new ClassModel();
            $kelas->id = Str::uuid();
            $kelas->name = $request->name;
            if (isset($request->teacher_id)) {
                $kelas->teacher_id = $request->teacher_id;
            }
            $kelas->school_id = auth()->id();
            $kelas->save();

            return $this->responseRepository->ResponseSuccess(null, "Berhasil membuat data kelas", 201);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal membuat data kelas", 'Internal Server Error !', 500);
        }
    }

    public function show($id)
    {
        try {
            $kelas = ClassModel::with('students')->find($id);
            return $this->responseRepository->ResponseSuccess($kelas, "ClassModel berhasil didapatkan", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mendapatkan data kelas", 'Internal Server Error !', 500);
        }
    }

    public function update(EditClassRequest $request, $id)
    {
        try {
            $kelas = ClassModel::find($id);
            $kelas->name = $request->name;
            if (isset($request->teacher_id)) {
                $kelas->teacher_id = $request->teacher_id;
            }
            $kelas->save();

            return $this->responseRepository->ResponseSuccess(null, "Berhasil mengubah data kelas", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Gagal mengubah data kelas", $e->getMessage() . "<br>In File: " . $e->getFile() . "<br>The exception was created on line: " . $e->getLine(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kelas = ClassModel::find($id);
            $kelas->delete();
            return $this->responseRepository->ResponseSuccess(null, "Success menghapus data kelas", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error menghapus data kelas", "Error menghapus data kelas" . " " . $e->getMessage(), 500);
        }
    }

    public function assign(AssignSiswaRequest $request, $id)
    {
        try {
            $kelas = ClassModel::find($id);
            if (!$kelas) {
                return $this->responseRepository->ResponseError("ClassModel tidak ditemukan", "ClassModel tidak ditemukan", 404);
            }
            for ($i = 0; $i < count($request->student_id); $i++) {
                $student = Student::find($request->student_id[$i]);
                if (!$student->class_id) {
                    $student->class_id = $id;
                    $student->save();
                }
            }
            return $this->responseRepository->ResponseSuccess(null, "Berhasil assign students ke dalam kelas", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error assign students ke dalam kelas", "Error assign students ke dalam kelas" . " " . $e->getMessage(), 500);
        }
    }
    public function unassign(AssignSiswaRequest $request, $id)
    {
        try {
            $kelas = ClassModel::find($id);
            if (!$kelas) {
                return $this->responseRepository->ResponseError("ClassModel tidak ditemukan", "ClassModel tidak ditemukan", 404);
            }
            for ($i = 0; $i < count($request->student_id); $i++) {
                $student = Student::where('class_id', $id)->where('id', $request->student_id[$i])->first();
                $student->class_id = null;
                $student->save();
            }
            return $this->responseRepository->ResponseSuccess(null, "Berhasil mengeluarkan students dari kelas", 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error mengeluarkan students dari kelas", "Error mengeluarkan students dari kelas" . " " . $e->getMessage(), 500);
        }
    }
}
