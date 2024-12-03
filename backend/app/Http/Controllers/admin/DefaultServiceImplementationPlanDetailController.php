<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultServiceImplementationPlanDetail;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefaultServiceImplementationPlanDetailController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_strategy' => "in:klasikal,kelompok"
        ]);
        if ($validator->fails()) {
            return $this->responseRepository->ResponseError($validator->errors(), "Service stragey not valid!", 400);
        }
        $dsipd = DefaultServiceImplementationPlanDetail::whereNull('default_service_implementation_plan_detail_id')
            ->where("service_strategy", $request->service_strategy)
            ->with(['child' => function($query) {
                return $query->orderBy("created_at");
            }])
            ->orderBy("created_at")
            ->get();
        return $this->responseRepository->ResponseSuccess($dsipd, "Successfull", 200);
    }
}
