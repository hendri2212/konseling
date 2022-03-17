<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PermissionRequest;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\admin\PermissionResource;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Permission;
use App\Models\Service;
use App\Repositories\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
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
            $service = Service::with('permission')->paginate(10);
            $data = ServiceResource::collection($service); 
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
    public function store(ServiceRequest $request)
    {
        try {
            $service = new Service;
            $service->id = Str::uuid();
            $service->service = $request->service;
            if ($request->has('description')) {
                $service->description = $request->description;
            }
            $service->save();
            return $this->responseRepository->ResponseSuccess(null, 'Successfull', JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, "Internal Server Error !", JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($service_id)
    {
        try {
            $service = Service::with('permission')->find($service_id);
            if (!$service) {
                return $this->responseRepository->ResponseSuccess(null);  
            }
            $data = new ServiceResource($service);
            return $this->responseRepository->ResponseSuccess($data);  
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, 'Internal Server Error !', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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

    //permission

    public function getPermission(Request $request) {
        try {
            $data = PermissionResource::collection(Permission::where('service_id', $request->service_id)->get());
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, "Internal Server Error !", JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addPermission(PermissionRequest $request) {
        try {
            $is_duplicate = Service::whereHas('permission', function($q) use ($request) {
                return $q->where('permission', $request->permission);
            })->find($request->service_id);
            if ($is_duplicate) {
                return $this->responseRepository->ResponseError([
                    'global' => 'Permission ini sudah pernah dibuat'
                ], "Permission ini sudah pernah dibuat", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $permission = new Permission;
            $permission->id = Str::uuid();
            $permission->permission = $request->permission;
            $permission->service_id = $request->service_id;
            $permission->save();
            return $this->responseRepository->ResponseSuccess(null, 'Successfull', JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->responseRepository->ResponseError(null, "Internal Server Error !", JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
