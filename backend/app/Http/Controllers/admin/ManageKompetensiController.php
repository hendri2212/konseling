<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ManageKompetensiRequest;
use App\Http\Resources\admin\ManageKompetensiResource;
use App\Models\Kompetensi;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;

class ManageKompetensiController extends Controller
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
            $data = ManageKompetensiResource::collection(Kompetensi::paginate(10));
            return $this->responseRepository->ResponseSuccess($data);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null);
        }
    }

    public function store(ManageKompetensiRequest $request)
    {
        try {
            $kompetensi = new Kompetensi();
            $kompetensi->skkpd = $request->skkpd;
            $kompetensi->pengenalan = $request->pengenalan;
            $kompetensi->akomodasi = $request->akomodasi;
            $kompetensi->tindakan = $request->tindakan;
            $kompetensi->save();
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
        // try {
        //     $data = ManageKompetensiResource::collection(Kompetensi::paginate(10));
        //     return $this->responseRepository->ResponseSuccess($data);
        // } catch (\Exception $e) {
        //     return $this->responseRepository->ResponseError(null);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
