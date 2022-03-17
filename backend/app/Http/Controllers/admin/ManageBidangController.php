<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ManageBidangRequest;
use App\Http\Resources\admin\ManageBidangResource;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use App\Models\Bidang;

class ManageBidangController extends Controller
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
            $data = ManageBidangResource::collection(Bidang::paginate(10));
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
    public function store(ManageBidangRequest $request)
    {
        try {
            $bidang = new Bidang;
            $bidang->nama = $request->nama;
            $bidang->save();
            return $this->responseRepository->ResponseSuccess(null);
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
