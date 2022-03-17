<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoalResource;
use App\Models\Soal;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;

class SoalController extends Controller
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
            $soal = Soal::paginate(1);
            $data = SoalResource::collection($soal);
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
