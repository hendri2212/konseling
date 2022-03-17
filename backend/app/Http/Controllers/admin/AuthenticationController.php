<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\AdminUser;
use App\Models\GuruUser;
use App\Repositories\AuthRepository;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthenticationController extends Controller
{
    private $responseRepository;
    // private $authRepository;

    public function __construct(ResponseRepository $rr, AuthRepository $ar)
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->responseRepository = $rr;
        $this->authRepository = $ar;
    }
    public function login(LoginRequest $request) {
        try {
            $user = AdminUser::where('email', $request->email)->first();
            $tokenName = 'admin-token';

            $abilities = $user->append('abilities')->abilities;

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken($tokenName, $abilities);
                $data = [
                    'token' => $token->plainTextToken
                ];
            }else{
                return $this->responseRepository->ResponseError(null, 'Invalid Email and Password !', Response::HTTP_UNAUTHORIZED);
            }
            return $this->responseRepository->ResponseSuccess($data, 'Logged In Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
