<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ShowServiceImplementationPlanRequest;
use App\Http\Resources\admin\ServiceImplementationPlanResource;
use App\Models\ServiceImplementationPlan;
use App\Models\ServiceImplementationPlanKlasikalDetail;
use App\Models\DefaultServiceImplementationPlanDetail;
use App\Models\ServiceImplementationPlanKlasikal;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceImplementationPlanKlasikalController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function index(Request $request, $survey_id)
    {
        // $validator = Validator::make($request->all(), [
        //     'service_strategy' => "in:1,2,3,4,klasikal,individual,group,other"
        // ]);
        // if ($validator->fails()) {
        //     return $this->responseRepository->ResponseError($validator->errors(), "Service stragey not valid!", 400);
        // }
        $sip = ServiceImplementationPlanKlasikal::with('surveyItem')->where("survey_id", $survey_id)->get();

        $response = $sip;
        // $pagination = [
        //     'max_page' => ceil($count_attempts / $max),
        //     'next' => null
        // ];
        // if ($page < $pagination['max_page']) {
        //     $pagination['next'] = route('surveys.result_of_surveys', ['survey_id' => $survey_id, 'page' => $page + 1]);
        // }
        return $this->responseRepository->ResponseSuccess($response, "Successfull", 200);
    }

    public function show($sip_id)
    {
        $sip = ServiceImplementationPlanKlasikal::with(['serviceImplementationPlanDetails' => function ($q) {
            return $q->where("parent_id", NULL)->orderBy("created_at");
        }, "serviceImplementationPlanDetails.child" => function ($q) {
            return $q->orderBy("created_at");
        }])->find($sip_id);

        return $this->responseRepository->ResponseSuccess($sip, "Successfull", 200);
    }

    private function create_service_implementation_plan_detail($sip_id, $parent_id, $child)
    {
        if ($child != null) {
            $create_sip_detail = new ServiceImplementationPlanKlasikalDetail();
            $create_sip_detail->id = Str::uuid();
            $create_sip_detail->value = $child["value"];
            $create_sip_detail->parent_id = $parent_id;
            $create_sip_detail->sip_id = $sip_id;
            $create_sip_detail->school_id = auth()->user()->school_id;
            $create_sip_detail->created_at = round(microtime(true) * 1000);
            $create_sip_detail->save();

            if (count($child["child"]) > 0) {
                for ($i = 0; $i < count($child["child"]); $i++) {
                    $this->create_service_implementation_plan_detail($sip_id, $create_sip_detail->id, $child["child"][$i]);
                }
            }
        }
    }

    // private function move_default_to_service_implementation_plan_detail($sip_id)
    // {
    //     $dsipd = DefaultServiceImplementationPlanDetail::whereNull('default_service_implementation_plan_detail_id')
    //         ->with('child')
    //         ->get();
    //     for ($i = 0; $i < count($dsipd); $i++) {
    //         $this->create_service_implementation_plan_detail($sip_id, null, $dsipd[$i]);
    //     }
    // }

    // private function create_service_implementation_plan($survey_id, $survey_item_id, $school_id)
    // {

    //     $this->move_default_to_service_implementation_plan_detail($create_sip->id);
    // }

    public function store(Request $request, $survey_id)
    {
        $validator = Validator::make($request->all(), [
            "survey_item_id" => "required|exists:survey_items,id",
            "service_implementation_plan_details.*.value" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors(),
                "message" => "Payload tidak valid !"
            ], 400);
        }

        $survey_item_id = $request->survey_item_id;

        $sip = ServiceImplementationPlanKlasikal::where("survey_id", $survey_id)->where("survey_item_id", $survey_item_id)->where("school_id", auth()->user()->school_id);
        if ($sip->exists()) {
            return $this->responseRepository->ResponseError([], "Service implementation plan is exists!", 400);
        }

        DB::beginTransaction();
        try {
            $create_sip = new ServiceImplementationPlanKlasikal();
            $create_sip->id = Str::uuid();
            $create_sip->survey_id = $survey_id;
            $create_sip->survey_item_id = $survey_item_id;
            $create_sip->school_id = auth()->user()->school_id;
            $create_sip->save();

            for ($i = 0; $i < count($request->service_implementation_plan_details); $i++) {
                $this->create_service_implementation_plan_detail($create_sip->id, null, $request->service_implementation_plan_details[$i]);
            }


            $sip = ServiceImplementationPlanKlasikal::with(["serviceImplementationPlanDetails" => function ($q) {
                return $q->whereNull("parent_id");
            }, "serviceImplementationPlanDetails.child"])->where("survey_id", $survey_id)->where("survey_item_id", $survey_item_id)->where("school_id", auth()->user()->school_id)->first();

            DB::commit();

            return $this->responseRepository->ResponseSuccess($sip, "success create service implementation plan klasikal !", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseRepository->ResponseError($e, "Create service implementation plan failed !", 500);
        }
    }

    public function save(Request $request, $sip_id)
    {
        DB::beginTransaction();
        try {
            ServiceImplementationPlanKlasikalDetail::where('sip_id', $sip_id)->delete();

            for ($i = 0; $i < count($request->service_implementation_plan_details); $i++) {
                $this->create_service_implementation_plan_detail($sip_id, null, $request->service_implementation_plan_details[$i]);
            }

            DB::commit();

            $sip = ServiceImplementationPlanKlasikal::with(["serviceImplementationPlanDetails" => function ($q) {
                return $q->whereNull("parent_id");
            }, "serviceImplementationPlanDetails.child"])->where("id", $sip_id)->where("school_id", auth()->user()->school_id)->first();

            return $this->responseRepository->ResponseSuccess($sip, "Successfull", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseRepository->ResponseError($e, "Create service implementation plan failed !", 500);
        }
    }
}
