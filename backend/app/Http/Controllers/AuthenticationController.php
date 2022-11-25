<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginSekolahDanGuruRequest;
use App\Http\Requests\sekolah\RegisterRequest;
use App\Models\GuruUser;
use App\Models\SekolahUser;
use App\Repositories\ResponseRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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

            $user = SekolahUser::where('email', $request->email)->first();
            $tokenName = 'sekolah-token';
        
            $user = new SekolahUser;
            $user->id = Str::uuid();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // event(new Registered($user));

            $abilities = [];
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

    public function login(LoginSekolahDanGuruRequest $request) {
        try {
            if($request->type == 'sekolah'){
                $user = SekolahUser::where('email', $request->email)->first();
                $tokenName = 'sekolah-token';
            }else{
                $user = GuruUser::where('username', $request->email)->first();
                $tokenName = 'guru-token';
            }
            if ($user && Hash::check($request->password, $user->password)) {
                $abilities =  $user->append('abilities')->abilities;
                $token = $user->createToken($tokenName, $abilities);
                $data = [
                    'token' => $token->plainTextToken,
                    'as' => $request->type == 'sekolah' ? 'sekolah' : 'guru'
                ];
            }else{
                if($request->type == 'sekolah'){
                    $username = "Email";
                }else{
                    $username = "Username";
                }
                return $this->responseRepository->ResponseError(null, "Invalid {$username} and Password !", Response::HTTP_UNAUTHORIZED);
            }

            return $this->responseRepository->ResponseSuccess($data, 'Logged In Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me() {
        $user = auth()->user();
        $user['as'] = Auth::guard('sekolah')->check() ? 'sekolah' : 'guru';
        return $this->responseRepository->ResponseSuccess($user);
        // return auth()->user()->role->permission->append('permission_merge')->pluck('permission_merge');
    }

    
}
