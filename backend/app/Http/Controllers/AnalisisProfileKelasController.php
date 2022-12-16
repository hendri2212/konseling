<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\SiswaUser;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisProfileKelasController extends Controller
{
    public function profile_kelas($id){
        $allResponden = Soal::leftJoin('jawaban', 'jawaban.soal_id','=', 'soal.id')
        ->where('jawaban.angket_id', $id)
        ->select(DB::raw("sum(jawaban) responden"))
        ->first()->responden;
        $data_per_bidang = Soal::leftJoin('jawaban', 'jawaban.soal_id','=', 'soal.id')
        ->join('bidang', 'soal.bidang_id', '=', 'bidang.id')
        ->where('jawaban.angket_id', $id)
        ->groupBy('soal.bidang_id', 'bidang.nama')
        ->select(DB::raw("bidang.nama as bidang, sum(jawaban) responden, sum(jawaban)/$allResponden*100 prosentase"))
        ->get();
        $data = Soal::leftJoin('jawaban', 'jawaban.soal_id','=', 'soal.id')
        ->where('jawaban.angket_id', $id)
        ->groupBy('soal.id', 'soal')
        ->select(DB::raw("soal, sum(jawaban) responden, sum(jawaban)/$allResponden*100 prosentase"))
        ->get()->map(function($soal, $key) {
            $soal->no = $key+1;
            $soal->prosentase = round($soal->prosentase, 1) . '%';
            $soal->prioritas = $soal->prosentase >= 2 ? "TINGGI" : ($soal->prosentase >= 1 ? "SEDANG" : "RENDAH");
            return $soal;
        });
        $label = $data_per_bidang->map(function($p){
            return $p->bidang . ' ' . '(' . round($p->prosentase, 1) . '%)';
        });
        $data_akumulasi = $data_per_bidang->map(function($p){
            return $p->responden;
        });
        $data_prosentase = $data_per_bidang->map(function($p){
            return round($p->prosentase, 1) . '%';
        });
        return [
            'list' => $data,
            'akumulasi' => [
                'label' => $label,
                'data' => $data_akumulasi,
                'prosentase' => $data_prosentase,
            ]
        ];
    }

    public function profile_konseling($id){
        $data = Jawaban::leftJoin('siswa', 'jawaban.siswa_id','=', 'siswa.id')
        ->where('jawaban.angket_id', $id)
        ->groupBy('siswa.id', 'siswa.nisn', 'siswa.nama')
        ->select(DB::raw("nisn, nama, sum(jawaban) jumlah, sum(jawaban)/50*100 prosentase"))
        ->get()->map(function($siswa, $key) {
            $siswa->no = $key+1;
            $siswa->prosentase = round($siswa->prosentase, 1) . '%';
            return $siswa;
        });
        return $data;
    }
}
