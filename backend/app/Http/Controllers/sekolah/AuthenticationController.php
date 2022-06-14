<?php

namespace App\Http\Controllers\sekolah;

use App\Http\Controllers\Controller;
use App\Http\Requests\sekolah\LoginRequest;
use App\Http\Requests\sekolah\RegisterRequest;
use App\Models\SekolahUser;
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

    
}
