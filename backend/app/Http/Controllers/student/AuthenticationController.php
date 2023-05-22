<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    private $responseRepository;
    
    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function peserta()
    {
        return Student::all();
    }

    public function login(Request $request) {
        try {
            $user = Student::where('email', $request->email)->first();
            $tokenName = 'students-token';
            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken($tokenName);
                $data = [
                    'token' => $token->plainTextToken,
                ];
            }else{
                return $this->responseRepository->ResponseError(null, "Email dan password salah !", 401);
            }

            return $this->responseRepository->ResponseSuccess($data, 'Berhasil login !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', 500);
        }
    }

    public function me() {
        $user = auth()->user()->with('class')->first();
        return $this->responseRepository->ResponseSuccess($user);
        // return auth()->user()->role->permission->append('permission_merge')->pluck('permission_merge');
    }
}
