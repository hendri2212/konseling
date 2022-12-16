<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginRequest as AdminLoginRequest;
use App\Models\AdminUser;
use App\Repositories\AuthRepository;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
    public function login(AdminLoginRequest $request) {
        try {
            $user = AdminUser::where('username', $request->username)->first();
            $tokenName = 'admin-token';

            $abilities = [];

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken($tokenName, $abilities);
                $data = [
                    'token' => $token->plainTextToken,
                    'as' => 'admin',
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
