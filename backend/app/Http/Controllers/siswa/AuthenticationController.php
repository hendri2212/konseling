<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\SiswaUser;
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

    public function login(Request $request) {
        try {
            $user = SiswaUser::where('email', $request->email)->first();
            $tokenName = 'siswa-token';
            if ($user && Hash::check($request->password, $user->password)) {
                // $abilities =  $user->append('abilities')->abilities;
                $token = $user->createToken($tokenName);
                $data = [
                    'token' => $token->plainTextToken,
                ];
            }else{
                return $this->responseRepository->ResponseError(null, "Invalid Email and Password !", Response::HTTP_UNAUTHORIZED);
            }

            return $this->responseRepository->ResponseSuccess($data, 'Logged In Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me() {
        $user = auth()->user();
        return $this->responseRepository->ResponseSuccess($user);
        // return auth()->user()->role->permission->append('permission_merge')->pluck('permission_merge');
    }
}
