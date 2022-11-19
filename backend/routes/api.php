<?php

use App\Http\Controllers\admin\AuthenticationController as AdminAuthenticationController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\AnalisisProfileKelasController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\guru\AuthenticationController as GuruAuthenticationController;
use App\Http\Controllers\sekolah\AuthenticationController as SekolahAuthenticationController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\guru\UjianController;
use App\Http\Controllers\sekolah\GuruController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\guru\VerifyEmailController;
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
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
    
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::middleware('auth:sekolah,guru')->get('me', [AuthenticationController::class, 'me']);
    Route::prefix('sekolah')->group(function() {
        Route::post('register', [SekolahAuthenticationController::class, 'register']);
        Route::middleware('auth:sekolah')->group(function() {
            Route::resource('kelas', KelasController::class);
            Route::get('guru/search', [GuruController::class, 'search']);
            Route::resource('guru', GuruController::class);
            // Route::get('ability', [GuruAuthenticationController::class, 'me']);
            // Route::resource('ujian', UjianController::class);
        });
    });

    Route::prefix('guru')->group(function() {
        Route::post('login', [GuruAuthenticationController::class, 'login']);
        // Route::resource('guru', GuruController::class);
        // Route::post('register', [GuruAuthenticationController::class, 'register']);
        
        Route::middleware('auth:guru')->group(function() {
            Route::get('kelas', [KelasController::class, 'index']);
            Route::get('analisis-profile-kelas/{id}', [AnalisisProfileKelasController::class, 'profile_kelas']);
            Route::get('analisis-profile-konseling/{id}', [AnalisisProfileKelasController::class, 'profile_konseling']);
            // Route::get('ability', [GuruAuthenticationController::class, 'me']);
            // Route::get('me', [GuruKelasController::class, 'me']);
            Route::get('me', [GuruController::class, 'me']);
            // Route::resource('kelas', GuruKelasController::class)->middleware('ability:kelas.*');
            Route::patch('ujian/{id}/open', [UjianController::class, 'open']);
            Route::patch('ujian/{id}/close', [UjianController::class, 'close']);
            Route::get('ujian/kelas/{id}', [UjianController::class, 'setiapKelas']);
            Route::resource('ujian', UjianController::class);
        });
    });
    
    
    Route::post('admin/login', [AdminAuthenticationController::class, 'login']);
    Route::middleware('auth:admin')->group(function() {
        Route::resource('service', ServiceController::class)->middleware('ability:service.*');
        Route::get('service/{service_id}/permission', [ServiceController::class, 'getPermission'])->middleware('ability:service.*, service.permission.list');
        Route::post('service/{service_id}/permission', [ServiceController::class, 'addPermission'])->middleware('ability:service.*, service.permission.add');
        Route::resource('role', RoleController::class)->middleware('ability:role.*');
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

