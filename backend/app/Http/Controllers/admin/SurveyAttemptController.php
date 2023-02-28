<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\siswa\SurveyResource;
use App\Models\SurveyAttempt;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;

class SurveyAttemptController extends Controller
{
    private $responseRepository;

    public function __construct(ResponseRepository $rr)
    {
        $this->responseRepository = $rr;
    }

    public function show($id, Request $request)
    {
        try {
            $max = 10;
            $page = isset($request->page) ? ((int)$request->page >= 1 ? (int)$request->page : 1)  : 1;
            $count_attempts = SurveyAttempt::whereSurveyId($id)->count();
            $attempts = SurveyAttempt::whereSurveyId($id)->withSiswa()->pagination($max);
            // $angket = Survey::whereIn('class_id', $class_id)->paginate($max);
            $data = SurveyResource::collection($attempts);
            $pagination = [
                'max_page' => ceil($count_attempts / $max),
                'next' => null
            ];
            if ($page < $pagination['max_page']) {
                $pagination['next'] = route('angket.index', ['page' => $page + 1]);
            }
            return $this->responseRepository->ResponseSuccess($data, "Successfull", 200, $pagination);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError($e->getMessage());
        }
    }
}
