<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\GuruUser;
use App\Repositories\ResponseRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    private $responseRepository;
    
    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function register(RegisterRequest $request) {
        try {

            $user = GuruUser::where('email', $request->email)->first();
            $tokenName = 'guru-token';
        
            $user = new GuruUser;
            $user->id = Str::uuid();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // event(new Registered($user));

            $abilities = $user->role->permission->append('permission_merge')->pluck('permission_merge');
            $token = $user->createToken($tokenName, $abilities);
            $data = [
                'token' => $token->plainTextToken
            ];

            return $this->responseRepository->ResponseSuccess($data, 'Registered Successfully !');
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(LoginRequest $request) {
        try {
            $user = GuruUser::where('email', $request->email)->first();
            $tokenName = 'guru-token';

            $abilities = $user->role->permission->append('permission_merge')->pluck('permission_merge');

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

    public function me() {
        return auth()->user()->role->permission->append('permission_merge')->pluck('permission_merge');
    }

    
}
