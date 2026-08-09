<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VillageApiController;

/*
|--------------------------------------------------------------------------
| API Routes - Stunting Singaparna
|--------------------------------------------------------------------------
|
| File ini berisi seluruh rute REST API untuk aplikasi mobile Stunting Singaparna.
| Semua endpoint otomatis memiliki prefix '/api'.
|
*/

// ==========================================
// 1. ENDPOINT PUBLIK (AUTENTIKASI)
// ==========================================
Route::post('/login', [AuthController::class, 'login']);

// ==========================================
// 2. ENDPOINT TERPROTEKSI (WAJIB TOKEN SANCTUM)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // Auth Info & Logout
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Ringkasan Dashboard Mobile App
    Route::get('/dashboard', [VillageApiController::class, 'dashboard']);

    // ------------------------------------------
    // MODUL 1: DATA SASARAN (TARGET DATA)
    // ------------------------------------------
    Route::get('/targets', [VillageApiController::class, 'getTargets']);
    Route::post('/targets', [VillageApiController::class, 'storeTarget']);
    Route::put('/targets/{id}', [VillageApiController::class, 'updateTarget']);
    Route::delete('/targets/{id}', [VillageApiController::class, 'destroyTarget']);

    // ------------------------------------------
    // MODUL 2: DATA PENDUKUNG (SUPPORT DATA)
    // ------------------------------------------
    Route::get('/supports', [VillageApiController::class, 'getSupports']);
    Route::post('/supports', [VillageApiController::class, 'storeSupport']);
    Route::put('/supports/{id}', [VillageApiController::class, 'updateSupport']);
    Route::delete('/supports/{id}', [VillageApiController::class, 'destroySupport']);

    // ------------------------------------------
    // MODUL 3: IDENTIFIKASI KENDALA (CONSTRAINTS)
    // ------------------------------------------
    Route::get('/constraints', [VillageApiController::class, 'getConstraints']);
    Route::post('/constraints', [VillageApiController::class, 'storeConstraint']);
    Route::put('/constraints/{id}', [VillageApiController::class, 'updateConstraint']);
    Route::delete('/constraints/{id}', [VillageApiController::class, 'destroyConstraint']);

    // ------------------------------------------
    // MODUL 4: PENYEDIAAN ANGGARAN (BUDGETS)
    // ------------------------------------------
    Route::get('/budgets', [VillageApiController::class, 'getBudgets']);
    Route::post('/budgets', [VillageApiController::class, 'storeBudget']);
    Route::put('/budgets/{id}', [VillageApiController::class, 'updateBudget']);
    Route::delete('/budgets/{id}', [VillageApiController::class, 'destroyBudget']);

    // ------------------------------------------
    // MODUL 5: CAPAIAN LAYANAN (SERVICE DATA)
    // ------------------------------------------
    Route::get('/services', [VillageApiController::class, 'getServices']);
    Route::post('/services', [VillageApiController::class, 'storeService']);
    Route::put('/services/{id}', [VillageApiController::class, 'updateService']);
    Route::delete('/services/{id}', [VillageApiController::class, 'destroyService']);
});