<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginRequest;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\School;
use App\Repositories\ResponseRepository;
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

    // public function register(RegisterRequest $request) {
    //     try {

    //         $user = School::where('email', $request->email)->first();
    //         $tokenName = 'schools-token';
        
    //         $user = new School;
    //         $user->id = Str::uuid();
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = Hash::make($request->password);
    //         $user->save();

    //         // event(new Registered($user));

    //         $abilities = [];
    //         $token = $user->createToken($tokenName, $abilities);
    //         $data = [
    //             'token' => $token->plainTextToken
    //         ];

    //         return $this->responseRepository->ResponseSuccess($data, 'Registered Successfully !');
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //         return $this->responseRepository->ResponseError(null, 'Internal Server Error !', 500);
    //     }
    // }

    public function login(LoginRequest $request) {
        try {
            if($request->type == "schools"){
                $user = School::where("email", $request->email)->first();
                $tokenName = "schools-token";
            }else if($request->type == "teachers") {
                $user = Teacher::where("email", $request->email)->first();
                $tokenName = "teachers-token";
            }else{
                $user = Admin::where("email", $request->email)->first();
                $tokenName = "admin-token";
            }
            if ($user && Hash::check($request->password, $user->password)) {
                $abilities =  [];
                $token = $user->createToken($tokenName, $abilities);
                $data = [
                    'token' => $token->plainTextToken,
                    'as' => $request->type
                ];
            }else{
                return $this->responseRepository->ResponseError(null, "Invalid Email and Password !", 401);
            }

            return $this->responseRepository->ResponseSuccess($data, 'Logged In Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage(), 'Internal Server Error !', 500);
        }
    }

    public function me() {
        $user = auth()->user();

        if (Auth::guard('admin')->check()) {
            $user['as'] = 'admin';
        } else if (Auth::guard('schools')->check()) {
            $user['as'] = 'schools';
        } else {
            $user['as'] = 'teachers';
        }
        
        return $this->responseRepository->ResponseSuccess($user);
    }

    
}
