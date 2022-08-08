<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RvController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//________________________________________________________________________________________________________

//route publique

Route::post('user/login', [AuthController::class, 'login']);

//Route privée

Route::group(['middleware' => ['auth:sanctum']], function () {

    //____________________________ User ___________________________________

    Route::get('user/liste', [AuthController::class, 'getAllUsers']);

    Route::get('user/{id}', [AuthController::class, 'getUserById']);

    Route::post('user/ajout', [AuthController::class, 'register']);

    Route::put('user/modifier/{id}', [AuthController::class, 'updateUser']);

    Route::delete('user/supprimer/{id}', [AuthController::class, 'deleteUser']);

    Route::get('user/rechercher/{name}', [AuthController::class, 'searchUser']);

    Route::post('user/logout', [AuthController::class, 'logout']);

    Route::get('user', [AuthController::class, 'getUser']);

    //____________________________ end User ___________________________________

    //____________________________ Medecins ___________________________________

    Route::get('medecins/liste', [MedecinController::class, 'getAllMedecins']);

    Route::get('medecin/{id}', [MedecinController::class, 'getMedecinById']);

    Route::post('medecin/ajout', [MedecinController::class, 'addMedecin']);

    Route::put('medecin/modifier/{id}', [MedecinController::class, 'updateMedecin']);

    Route::delete('medecin/supprimer/{id}', [MedecinController::class, 'deleteMedecin']);

    Route::get('medecin/rechercher/{prenom}', [MedecinController::class, 'searchMedecin']);

    //____________________________ End Medecins ___________________________________

    //____________________________ Patient ___________________________________

    Route::get('patients/liste', [PatientController::class, 'getAllPatients']);

    Route::get('patient/{id}', [PatientController::class, 'getPatientById']);

    Route::post('patient/ajout', [PatientController::class, 'addPatient']);

    Route::put('patient/modifier/{id}', [PatientController::class, 'updatePatient']);

    Route::delete('patient/supprimer/{id}', [PatientController::class, 'deletePatient']);

    Route::get('patient/rechercher/{prenom}', [PatientController::class, 'searchPatient']);

    //____________________________ End Patient ___________________________________

    //____________________________ Rv ___________________________________

    Route::get('rv/liste', [RvController::class, 'getAllRv']);

    Route::get('rv/{id}', [RvController::class, 'getRvById']);

    Route::post('rv/ajout', [RvController::class, 'addRv']);

    Route::put('rv/modifier/{id}', [RvController::class, 'updateRv']);

    Route::delete('rv/supprimer/{id}', [RvController::class, 'deleteRv']);

    //____________________________ End Rv ___________________________________

});