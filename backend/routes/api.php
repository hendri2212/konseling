<?php

use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\guru\AuthenticationController as GuruAuthenticationController;
use App\Http\Controllers\sekolah\AuthenticationController as SekolahAuthenticationController;
use App\Http\Controllers\sekolah\KelasController as Sekolah_KelasController;
use App\Http\Controllers\guru\UjianController;
use App\Http\Controllers\sekolah\GuruController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\guru\VerifyEmailController;
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
    
    Route::prefix('sekolah')->group(function() {
        Route::post('login', [SekolahAuthenticationController::class, 'login']);
        Route::post('register', [SekolahAuthenticationController::class, 'register']);
        
        Route::middleware('auth:sekolah')->group(function() {
            Route::get('me', [SekolahAuthenticationController::class, 'me']);
            Route::resource('kelas', Sekolah_KelasController::class);
            Route::get('guru/search', [GuruController::class, 'search']);
            Route::resource('guru', GuruController::class);
            // Route::get('ability', [GuruAuthenticationController::class, 'me']);
            // Route::resource('ujian', UjianController::class);
        });
    });

    Route::prefix('guru')->group(function() {
        Route::post('login', [GuruAuthenticationController::class, 'login']);
        Route::resource('ujian', UjianConctroller::class);
        // Route::resource('guru', GuruController::class);
        // Route::post('register', [GuruAuthenticationController::class, 'register']);
        
        // Route::middleware('auth:guru')->group(function() {
        //     // Route::get('ability', [GuruAuthenticationController::class, 'me']);
        //     Route::get('me', [GuruKelasController::class, 'me']);
        //     Route::resource('kelas', GuruKelasController::class)->middleware('ability:kelas.*');
        //     Route::resource('ujian', UjianController::class);
        // });
    });
    
    
    Route::post('admin/login', [AuthenticationController::class, 'login']);
    Route::middleware('auth:admin')->group(function() {
        Route::resource('service', ServiceController::class)->middleware('ability:service.*');
        Route::get('service/{service_id}/permission', [ServiceController::class, 'getPermission'])->middleware('ability:service.*, service.permission.list');
        Route::post('service/{service_id}/permission', [ServiceController::class, 'addPermission'])->middleware('ability:service.*, service.permission.add');
        Route::resource('role', RoleController::class)->middleware('ability:role.*');
    });


    Route::resource('soal', SoalController::class);



});

