<?php

use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\admin\FieldComponentLayananController;
use App\Http\Controllers\admin\ServiceComponentController;
use App\Http\Controllers\admin\TopicController;
use App\Http\Controllers\admin\RequirementFormulationController;
use App\Http\Controllers\admin\SkkpdController;
use App\Http\Controllers\admin\ClassAnalysisController;
use App\Http\Controllers\admin\SurveyController;
use App\Http\Controllers\admin\ClassModelController;
use App\Http\Controllers\admin\GuruController;
use App\Http\Controllers\admin\ManageSiswaController;
use App\Http\Controllers\admin\ServiceImplementationPlanKlasikalController;
use App\Http\Controllers\admin\SurveyAttemptController;
use App\Http\Controllers\admin\SurveyItemController;
use App\Http\Controllers\student\AuthenticationController as StudentAuthenticationController;
use App\Http\Controllers\student\SurveyController as SiswaSurveyController;
use App\Http\Controllers\admin\DefaultServiceImplementationPlanDetailController;
// use App\Http\Controllers\student\SurveyItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::post('login', [AuthenticationController::class, 'login']);
        Route::middleware('auth:admin,schools,teachers')->get('me', [AuthenticationController::class, 'me']);
        Route::middleware('auth:admin')->group(function () {
            Route::resource('service-components', ServiceComponentController::class);
            Route::prefix('service-components/{id}/topics')->group(function () {
                Route::get('', [TopicController::class, 'index'])->name('topics.index');
                Route::post('', [TopicController::class, 'store'])->name('topics.store');
                Route::put('{topic_id}', [TopicController::class, 'update'])->name('topics.update');
                Route::delete('{topic_id}', [TopicController::class, 'destroy'])->name('topics.destroy');
            });

            Route::get('topics', [TopicController::class, 'all'])->name('topics.all');

            Route::resource('field-components', FieldComponentLayananController::class);
            Route::prefix('field-components/{id}/skkpd')->group(function () {
                Route::get('', [SkkpdController::class, 'index'])->name('skkpd.index');
                Route::post('', [SkkpdController::class, 'store'])->name('skkpd.store');
                Route::prefix('{skkpd_id}')->group(function () {
                    Route::get('', [SkkpdController::class, 'show'])->name('skkpd.show');
                    Route::put('', [SkkpdController::class, 'update'])->name('skkpd.update');
                    Route::delete('', [SkkpdController::class, 'destroy'])->name('skkpd.destroy');
                    Route::prefix('requirements-formulation')->group(function () {
                        Route::get('', [RequirementFormulationController::class, 'index'])->name('requirements_formulation.index');
                        Route::post('', [RequirementFormulationController::class, 'store'])->name('requirements_formulation.store');
                        Route::put('{requirement_formulation_id}', [RequirementFormulationController::class, 'update'])->name('requirements_formulation.update');
                        Route::delete('{requirement_formulation_id}', [RequirementFormulationController::class, 'destroy'])->name('requirements_formulation.destroy');
                    });
                });
            });
            Route::get('requirements-formulation/search', [RequirementFormulationController::class, 'search'])->name('requirements_formulation.search');
            Route::resource('survey-items', SurveyItemController::class);
        });

        Route::middleware('auth:schools,teachers')->get('classes', [ClassModelController::class, 'index']);

        Route::middleware('auth:schools')->group(function () {
            Route::get('teachers/search', [GuruController::class, 'search']);
            Route::resource('teachers', GuruController::class);
            Route::post('classes/{id}/assign', [ClassModelController::class, 'assign']);
            Route::post('classes/{id}/unassign', [ClassModelController::class, 'unassign']);
            Route::resource('classes', ClassModelController::class);
            Route::resource('students', ManageSiswaController::class);
        });

        Route::middleware('auth:teachers')->group(function () {
            Route::resource('surveys', SurveyController::class);
            Route::prefix('surveys')->group(function () {
                Route::patch('{id}/open', [SurveyController::class, 'open']);
                Route::patch('{id}/close', [SurveyController::class, 'close']);
                Route::get('{survey_id}/results', [SurveyAttemptController::class, 'resultOfSurveys'])->name('surveys.result_of_surveys');
                Route::get('{survey_id}/result-per-survey-items', [SurveyAttemptController::class, 'resultOfSurveysPerSurveyItems'])->name('surveys.result_of_surveys_per_survey_items');
                Route::get('{survey_id}/service-implementation-plan-klasikals', [ServiceImplementationPlanKlasikalController::class, 'index']);
                Route::post('{survey_id}/service-implementation-plan-klasikals', [ServiceImplementationPlanKlasikalController::class, 'store']);
                Route::get('{survey_id}/service-implementation-plans-klasikals/{survey_item_id}', [ServiceImplementationPlanKlasikalController::class, 'show']);
                // Route::post('{survey_id}/service-implementation-plans/{survey_item_id}', [ServiceImplementationPlanKlasikalController::class, 'store']);
                // Route::get('service-implementation-plans/{sip_id}', [ServiceImplementationPlanKlasikalController::class, 'show']);
                // Route::get('classes/{id}', [SurveyController::class, 'setiapClassModel']);
            });

            Route::get('default-service-implementation-plan-details', [DefaultServiceImplementationPlanDetailController::class, 'index']);

            Route::prefix('service-implementation-plan-klasikals')->group(function () {
                Route::get('{sip_id}', [ServiceImplementationPlanKlasikalController::class, 'show']);
                // Route::get('classes/{id}', [SurveyController::class, 'setiapClassModel']);
                // Route::put('{sip_id}', [ServiceImplementationPlanKlasikalController::class, 'save']);
            });
            Route::get('classes-analysis/{id}', [ClassAnalysisController::class, 'class_profile']);
            Route::get('analisis-profile-konseling/{id}', [ClassAnalysisController::class, 'profile_konseling']);

            // Route::get('default-service-implementation-plan-details', [DefaultServiceImplementationPlanDetailController::class, 'index']);
        });
    });

    Route::prefix('students')->group(function () {
        Route::post('login', [StudentAuthenticationController::class, 'login']);
        Route::middleware('auth:students')->group(function () {
            Route::get('me', [StudentAuthenticationController::class, 'me']);
            Route::prefix('surveys')->group(function () {
                Route::get('', [SiswaSurveyController::class, 'index']);
                Route::get('{id}', [SiswaSurveyController::class, 'show']);
                Route::get('{id}/status', [SiswaSurveyController::class, 'status']);
                Route::post('{id}/start-attempt', [SiswaSurveyController::class, 'startAttempt']);
                Route::get('{id}/attempt', [SiswaSurveyController::class, 'surveyItemAndResponse']);
                Route::get('{id}/attempt/lists', [SiswaSurveyController::class, 'lists']);
                Route::post('{id}/attempt/{id_survey_items}/answer', [SiswaSurveyController::class, 'answer']);
                Route::post('{id}/finish-attempt', [SiswaSurveyController::class, 'finishAttempt']);
            });
        });
    });
});
