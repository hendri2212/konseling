<?php

use App\Http\Controllers\admin\AuthenticationController as AdminAuthenticationController;
use App\Http\Controllers\admin\BidangLayananController;
use App\Http\Controllers\admin\ButirAngketKonselingController;
use App\Http\Controllers\admin\KomponenLayananController;
use App\Http\Controllers\admin\MateriController;
use App\Http\Controllers\admin\RumusanKebutuhanController;
use App\Http\Controllers\admin\SkkpdController;
// use App\Http\Controllers\admin\RoleController;
// use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\AnalisisProfileKelasController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\guru\AuthenticationController as GuruAuthenticationController;
use App\Http\Controllers\sekolah\AuthenticationController as SekolahAuthenticationController;
use App\Http\Controllers\guru\AngketController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\sekolah\GuruController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\guru\VerifyEmailController;
use App\Http\Controllers\sekolah\ManageSiswaController;
use App\Http\Controllers\siswa\AuthenticationController as SiswaAuthenticationController;
use App\Http\Controllers\SoalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function() {
    // Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    // ->middleware(['signed', 'throttle:6,1'])
    // ->name('verification.verify');

    Route::middleware('auth:sekolah,guru,admin')->get('me', [AuthenticationController::class, 'me']);
    
    Route::prefix('admin')->group(function() {
    
        Route::post('login', [AdminAuthenticationController::class, 'login']);
        Route::middleware('auth:admin')->group(function() {
            Route::get('komponen-layanan/materi', [MateriController::class, 'all'])->name('materi.all');
            Route::resource('komponen-layanan', KomponenLayananController::class);
            Route::prefix('komponen-layanan/{id}/materi')->group(function() {
                Route::get('', [MateriController::class, 'index'])->name('materi.index');
                Route::post('', [MateriController::class, 'store'])->name('materi.store');
                Route::put('{id_materi}', [MateriController::class, 'update'])->name('materi.update');
                Route::delete('{id_materi}', [MateriController::class, 'destroy'])->name('materi.destroy');
            });
            Route::resource('/bidang-layanan', BidangLayananController::class);
            Route::prefix('bidang-layanan/{id}/skkpd')->group(function() {
                Route::get('', [SkkpdController::class, 'index'])->name('skkpd.index');
                Route::post('', [SkkpdController::class, 'store'])->name('skkpd.store');
                Route::get('{id_skkpd}', [SkkpdController::class, 'show'])->name('skkpd.show');
                Route::put('{id_skkpd}', [SkkpdController::class, 'update'])->name('skkpd.update');
                Route::delete('{id_skkpd}', [SkkpdController::class, 'destroy'])->name('skkpd.destroy');

                Route::prefix('{id_skkpd}/rumusan-kebutuhan')->group(function() {
                    Route::get('', [RumusanKebutuhanController::class, 'index'])->name('rumusan_kebutuhan.index');
                    Route::post('', [RumusanKebutuhanController::class, 'store'])->name('rumusan_kebutuhan.store');
                    Route::put('{id_rumusan_kebutuhan}', [RumusanKebutuhanController::class, 'update'])->name('rumusan_kebutuhan.update');
                    Route::delete('{id_rumusan_kebutuhan}', [RumusanKebutuhanController::class, 'destroy'])->name('rumusan_kebutuhan.destroy');
                });
            });
            Route::get('rumusan-kebutuhan/search', [RumusanKebutuhanController::class, 'search'])->name('rumusan_kebutuhan.search');
            Route::resource('butir-angket-konseling', ButirAngketKonselingController::class);
            // Route::resource('service', ServiceController::class)->middleware('ability:service.*');
            // Route::get('service/{service_id}/permission', [ServiceController::class, 'getPermission'])->middleware('ability:service.*, service.permission.list');
            // Route::post('service/{service_id}/permission', [ServiceController::class, 'addPermission'])->middleware('ability:service.*, service.permission.add');
            // Route::resource('role', RoleController::class)->middleware('ability:role.*');
        });
    });
    
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::prefix('sekolah')->group(function() {
        Route::post('register', [SekolahAuthenticationController::class, 'register']);
        Route::middleware('auth:sekolah')->group(function() {
            Route::get('guru/search', [GuruController::class, 'search']);
            Route::resource('guru', GuruController::class);
            Route::post('kelas/{id}/assign', [KelasController::class, 'assign']);
            Route::post('kelas/{id}/hapus', [KelasController::class, 'hapus']);
            Route::resource('kelas', KelasController::class);
            Route::resource('siswa', ManageSiswaController::class);
        });
    });

    Route::prefix('guru')->group(function() {
        Route::post('login', [GuruAuthenticationController::class, 'login']);
        
        Route::middleware('auth:guru')->group(function() {
            Route::get('me', [GuruController::class, 'me']);
            Route::get('kelas', [KelasController::class, 'index']);
            Route::resource('angket', AngketController::class);
            Route::patch('angket/{id}/open', [AngketController::class, 'open']);
            Route::patch('angket/{id}/close', [AngketController::class, 'close']);
            Route::get('angket/kelas/{id}', [AngketController::class, 'setiapKelas']);
            Route::get('analisis-profile-kelas/{id}', [AnalisisProfileKelasController::class, 'profile_kelas']);
            Route::get('analisis-profile-konseling/{id}', [AnalisisProfileKelasController::class, 'profile_konseling']);
        });
    });

    Route::prefix('siswa')->group(function() {
        Route::post('login', [SiswaAuthenticationController::class, 'login']);
        
        Route::get('peserta', [SiswaAuthenticationController::class, 'peserta']);
        Route::middleware('auth:siswa')->group(function() {
            Route::get('me', [SiswaAuthenticationController::class, 'me']);
            Route::get('list-soal', [SoalController::class, 'listSoal']);
            Route::post('soal/jawab', [SoalController::class, 'jawab']);
            Route::resource('soal', SoalController::class);
        });
    });



});

