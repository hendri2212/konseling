<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RoleRequest;
use App\Http\Resources\admin\RoleResource;
use App\Models\Role;
use App\Models\RolePermission;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $role = Role::with('permission')->paginate(10);
            // return $role;
            $data = RoleResource::collection($role); 
            return $this->responseRepository->ResponseSuccess($data);  
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = new Role;
            $role->id = Str::uuid();
            $role->role = $request->role;
            $role->description = $request->description;
            $role->save();

            for ($i=0; $i<count($request->permission); $i++) {
                $role_permission = new RolePermission;
                $role_permission->id = Str::uuid();
                $role_permission->role_id = $role->id;
                $role_permission->permission_id = $request->permission[$i];
                $role_permission->save();
            }

            return $this->responseRepository->ResponseSuccess(null, "Success created role", JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
