<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\MeasurementController;
use App\Http\Controllers\Api\VillageApiController;

/*
|--------------------------------------------------------------------------
| API Routes - Stunting Singaparna
|--------------------------------------------------------------------------
|
| Semua route di file ini otomatis memiliki prefix:
| /api
|
| Contoh:
| GET /api/dashboard
| POST /api/login
|
|--------------------------------------------------------------------------
*/


// ==========================================================================
// API HEALTH CHECK
// ==========================================================================

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API Stunting Singaparna aktif',
        'status'  => 'online',
        'time'    => now()->toDateTimeString(),
    ]);
});


// ==========================================================================
// 1. PUBLIC ROUTES
// ==========================================================================
// Route yang dapat diakses tanpa Bearer Token
// ==========================================================================

Route::post('/login', [AuthController::class, 'login']);

// Jika AuthController memiliki method register(), aktifkan:
// Route::post('/register', [AuthController::class, 'register']);


// ==========================================================================
// 2. PROTECTED ROUTES
// ==========================================================================
// Semua route di bawah ini membutuhkan:
// Authorization: Bearer {token}
// ==========================================================================

Route::middleware('auth:sanctum')->group(function () {

    // ----------------------------------------------------------------------
    // AUTHENTICATION
    // ----------------------------------------------------------------------

    // Mendapatkan informasi user yang sedang login
    Route::get('/me', [AuthController::class, 'me']);

    // Logout dan menghapus token
    Route::post('/logout', [AuthController::class, 'logout']);


    // ----------------------------------------------------------------------
    // DASHBOARD
    // ----------------------------------------------------------------------

    Route::get('/dashboard', [
        VillageApiController::class,
        'dashboard'
    ]);


    // ----------------------------------------------------------------------
    // DATA ANAK
    // ----------------------------------------------------------------------

    Route::apiResource('children', ChildController::class);


    // ----------------------------------------------------------------------
    // DATA PENGUKURAN ANAK
    // ----------------------------------------------------------------------

    // Menambahkan pengukuran
    Route::post('/measurements', [
        MeasurementController::class,
        'store'
    ]);

    // Mengambil seluruh pengukuran berdasarkan anak
    Route::get('/children/{childId}/measurements', [
        MeasurementController::class,
        'indexByChild'
    ]);


    // ======================================================================
    // MODUL 1 - DATA SASARAN
    // ======================================================================

    Route::get('/targets', [
        VillageApiController::class,
        'getTargets'
    ]);

    Route::post('/targets', [
        VillageApiController::class,
        'storeTarget'
    ]);

    Route::put('/targets/{id}', [
        VillageApiController::class,
        'updateTarget'
    ]);

    Route::delete('/targets/{id}', [
        VillageApiController::class,
        'destroyTarget'
    ]);


    // ======================================================================
    // MODUL 2 - DATA PENDUKUNG
    // ======================================================================

    Route::get('/supports', [
        VillageApiController::class,
        'getSupports'
    ]);

    Route::post('/supports', [
        VillageApiController::class,
        'storeSupport'
    ]);

    Route::put('/supports/{id}', [
        VillageApiController::class,
        'updateSupport'
    ]);

    Route::delete('/supports/{id}', [
        VillageApiController::class,
        'destroySupport'
    ]);


    // ======================================================================
    // MODUL 3 - IDENTIFIKASI KENDALA
    // ======================================================================

    Route::get('/constraints', [
        VillageApiController::class,
        'getConstraints'
    ]);

    Route::post('/constraints', [
        VillageApiController::class,
        'storeConstraint'
    ]);

    Route::put('/constraints/{id}', [
        VillageApiController::class,
        'updateConstraint'
    ]);

    Route::delete('/constraints/{id}', [
        VillageApiController::class,
        'destroyConstraint'
    ]);


    // ======================================================================
    // MODUL 4 - PENYEDIAAN ANGGARAN
    // ======================================================================

    Route::get('/budgets', [
        VillageApiController::class,
        'getBudgets'
    ]);

    Route::post('/budgets', [
        VillageApiController::class,
        'storeBudget'
    ]);

    Route::put('/budgets/{id}', [
        VillageApiController::class,
        'updateBudget'
    ]);

    Route::delete('/budgets/{id}', [
        VillageApiController::class,
        'destroyBudget'
    ]);


    // ======================================================================
    // MODUL 5 - CAPAIAN LAYANAN
    // ======================================================================

    Route::get('/services', [
        VillageApiController::class,
        'getServices'
    ]);

    Route::post('/services', [
        VillageApiController::class,
        'storeService'
    ]);

    Route::put('/services/{id}', [
        VillageApiController::class,
        'updateService'
    ]);

    Route::delete('/services/{id}', [
        VillageApiController::class,
        'destroyService'
    ]);

});