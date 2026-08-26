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
| File ini berisi seluruh rute REST API untuk aplikasi mobile
| Stunting Singaparna.
|
| Semua endpoint otomatis memiliki prefix '/api'.
|
*/

// ==========================================
// 1. ENDPOINT PUBLIK
// ==========================================

// Login
Route::post('/login', [AuthController::class, 'login']);

// Register jika aplikasi membutuhkan pendaftaran user
// Route::post('/register', [AuthController::class, 'register']);


// ==========================================
// 2. ENDPOINT TERPROTEKSI
// WAJIB TOKEN SANCTUM
// ==========================================

Route::middleware('auth:sanctum')->group(function () {

    // ==========================================
    // AUTH / USER
    // ==========================================

    // Informasi user yang sedang login
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data' => $request->user(),
        ]);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);


    // ==========================================
    // DASHBOARD
    // ==========================================

    Route::get('/dashboard', [
        VillageApiController::class,
        'dashboard'
    ]);


    // ==========================================
    // MODUL 1: DATA SASARAN
    // TARGET DATA
    // ==========================================

    // Semua data sasaran
    Route::get('/targets', [
        VillageApiController::class,
        'getTargets'
    ]);

    // Detail sasaran
    Route::get('/targets/{id}', [
        VillageApiController::class,
        'showTarget'
    ]);

    // Tambah sasaran
    Route::post('/targets', [
        VillageApiController::class,
        'storeTarget'
    ]);

    // Update sasaran
    Route::put('/targets/{id}', [
        VillageApiController::class,
        'updateTarget'
    ]);

    // Hapus sasaran
    Route::delete('/targets/{id}', [
        VillageApiController::class,
        'destroyTarget'
    ]);


    // ==========================================
    // MODUL 2: DATA PENDUKUNG
    // SUPPORT DATA
    // ==========================================

    // Semua data pendukung
    Route::get('/supports', [
        VillageApiController::class,
        'getSupports'
    ]);

    // Detail data pendukung
    Route::get('/supports/{id}', [
        VillageApiController::class,
        'showSupport'
    ]);

    // Tambah data pendukung
    Route::post('/supports', [
        VillageApiController::class,
        'storeSupport'
    ]);

    // Update data pendukung
    Route::put('/supports/{id}', [
        VillageApiController::class,
        'updateSupport'
    ]);

    // Hapus data pendukung
    Route::delete('/supports/{id}', [
        VillageApiController::class,
        'destroySupport'
    ]);


    // ==========================================
    // MODUL 3: IDENTIFIKASI KENDALA
    // CONSTRAINTS
    // ==========================================

    // Semua kendala
    Route::get('/constraints', [
        VillageApiController::class,
        'getConstraints'
    ]);

    // Detail kendala
    Route::get('/constraints/{id}', [
        VillageApiController::class,
        'showConstraint'
    ]);

    // Tambah kendala
    Route::post('/constraints', [
        VillageApiController::class,
        'storeConstraint'
    ]);

    // Update kendala
    Route::put('/constraints/{id}', [
        VillageApiController::class,
        'updateConstraint'
    ]);

    // Hapus kendala
    Route::delete('/constraints/{id}', [
        VillageApiController::class,
        'destroyConstraint'
    ]);


    // ==========================================
    // MODUL 4: PENYEDIAAN ANGGARAN
    // BUDGETS
    // ==========================================

    // Semua anggaran
    Route::get('/budgets', [
        VillageApiController::class,
        'getBudgets'
    ]);

    // Detail anggaran
    Route::get('/budgets/{id}', [
        VillageApiController::class,
        'showBudget'
    ]);

    // Tambah anggaran
    Route::post('/budgets', [
        VillageApiController::class,
        'storeBudget'
    ]);

    // Update anggaran
    Route::put('/budgets/{id}', [
        VillageApiController::class,
        'updateBudget'
    ]);

    // Hapus anggaran
    Route::delete('/budgets/{id}', [
        VillageApiController::class,
        'destroyBudget'
    ]);


    // ==========================================
    // MODUL 5: CAPAIAN LAYANAN
    // SERVICE DATA
    // ==========================================

    // Semua layanan
    Route::get('/services', [
        VillageApiController::class,
        'getServices'
    ]);

    // Detail layanan
    Route::get('/services/{id}', [
        VillageApiController::class,
        'showService'
    ]);

    // Tambah layanan
    Route::post('/services', [
        VillageApiController::class,
        'storeService'
    ]);

    // Update layanan
    Route::put('/services/{id}', [
        VillageApiController::class,
        'updateService'
    ]);

    // Hapus layanan
    Route::delete('/services/{id}', [
        VillageApiController::class,
        'destroyService'
    ]);


    // ==========================================
    // MODUL 6: DATA INDIVIDU
    // INDIVIDUAL DATA
    // ==========================================

    // Semua data individu
    Route::get('/individuals', [
        VillageApiController::class,
        'getIndividuals'
    ]);

    // Detail individu
    Route::get('/individuals/{id}', [
        VillageApiController::class,
        'showIndividual'
    ]);

    // Tambah individu
    Route::post('/individuals', [
        VillageApiController::class,
        'storeIndividual'
    ]);

    // Update individu
    Route::put('/individuals/{id}', [
        VillageApiController::class,
        'updateIndividual'
    ]);

    // Hapus individu
    Route::delete('/individuals/{id}', [
        VillageApiController::class,
        'destroyIndividual'
    ]);


    // ==========================================
    // STATISTIK
    // ==========================================

    Route::get('/statistics', [
        VillageApiController::class,
        'statistics'
    ]);

});