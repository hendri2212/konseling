<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultServiceImplementationPlanDetail;
use Illuminate\Http\Request;

class DefaultServiceImplementationPlanDetailController extends Controller
{
    public function index()
    {
        $dsipd = DefaultServiceImplementationPlanDetail::whereNull('default_service_implementation_plan_detail_id')
            ->with('child')
            ->get();
        return response()->json($dsipd);
    }
}
