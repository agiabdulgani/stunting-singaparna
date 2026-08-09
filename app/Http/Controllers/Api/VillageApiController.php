<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TargetData;
use App\Models\SupportData;
use App\Models\Constraint;
use App\Models\Budget;
use App\Models\ServiceData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VillageApiController extends Controller
{
    // ==========================================
    // 0. RINGKASAN DASHBOARD (OVERVIEW)
    // ==========================================

    /**
     * GET /api/dashboard
     * Mengambil seluruh data dari 5 modul sekaligus untuk tampilan awal Mobile App
     */
    public function dashboard(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Seluruh data ringkasan stunting berhasil diambil',
            'data'    => [
                'target_data'  => TargetData::latest()->get(),
                'support_data' => SupportData::latest()->get(),
                'constraints'  => Constraint::latest()->get(),
                'budgets'      => Budget::latest()->get(),
                'service_data' => ServiceData::latest()->get(),
            ]
        ], 200);
    }

    // ==========================================
    // 1. DATA SASARAN (TARGET DATA)
    // ==========================================

    public function getTargets(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Data sasaran berhasil diambil',
            'data'    => TargetData::latest()->get()
        ], 200);
    }

    public function storeTarget(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'population_count'   => 'required|integer|min:0',
            'family_count'       => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count'     => 'required|integer|min:0',
        ]);

        $target = TargetData::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data sasaran berhasil ditambahkan',
            'data'    => $target
        ], 201);
    }

    public function updateTarget(Request $request, $id): JsonResponse
    {
        $target = TargetData::find($id);

        if (!$target) {
            return response()->json(['status' => 'error', 'message' => 'Data sasaran tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'population_count'   => 'required|integer|min:0',
            'family_count'       => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count'     => 'required|integer|min:0',
        ]);

        $target->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data sasaran berhasil diperbarui',
            'data'    => $target
        ], 200);
    }

    public function destroyTarget($id): JsonResponse
    {
        $target = TargetData::find($id);

        if (!$target) {
            return response()->json(['status' => 'error', 'message' => 'Data sasaran tidak ditemukan'], 404);
        }

        $target->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data sasaran berhasil dihapus'
        ], 200);
    }

    // ==========================================
    // 2. DATA PENDUKUNG (SUPPORT DATA)
    // ==========================================

    public function getSupports(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Data pendukung berhasil diambil',
            'data'    => SupportData::latest()->get()
        ], 200);
    }

    public function storeSupport(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name'           => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count'          => 'required|integer|min:0',
            'sma_ma_count'           => 'required|integer|min:0',
            'paud_teacher_count'     => 'required|integer|min:0',
        ]);

        $support = SupportData::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pendukung berhasil ditambahkan',
            'data'    => $support
        ], 201);
    }

    public function updateSupport(Request $request, $id): JsonResponse
    {
        $support = SupportData::find($id);

        if (!$support) {
            return response()->json(['status' => 'error', 'message' => 'Data pendukung tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'village_name'           => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count'          => 'required|integer|min:0',
            'sma_ma_count'           => 'required|integer|min:0',
            'paud_teacher_count'     => 'required|integer|min:0',
        ]);

        $support->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pendukung berhasil diperbarui',
            'data'    => $support
        ], 200);
    }

    public function destroySupport($id): JsonResponse
    {
        $support = SupportData::find($id);

        if (!$support) {
            return response()->json(['status' => 'error', 'message' => 'Data pendukung tidak ditemukan'], 404);
        }

        $support->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pendukung berhasil dihapus'
        ], 200);
    }

    // ==========================================
    // 3. IDENTIFIKASI KENDALA (CONSTRAINT)
    // ==========================================

    public function getConstraints(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Data kendala berhasil diambil',
            'data'    => Constraint::latest()->get()
        ], 200);
    }

    public function storeConstraint(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'scope'          => 'required|string|max:255',
            'problem'        => 'required|string',
            'cause'          => 'required|string',
            'recommendation' => 'required|string',
            'assessment'     => 'required|string|max:255',
            'budget_needed'  => 'required|numeric|min:0',
            'location_plan'  => 'required|string|max:255',
        ]);

        $constraint = Constraint::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kendala berhasil ditambahkan',
            'data'    => $constraint
        ], 201);
    }

    public function updateConstraint(Request $request, $id): JsonResponse
    {
        $constraint = Constraint::find($id);

        if (!$constraint) {
            return response()->json(['status' => 'error', 'message' => 'Data kendala tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'scope'          => 'required|string|max:255',
            'problem'        => 'required|string',
            'cause'          => 'required|string',
            'recommendation' => 'required|string',
            'assessment'     => 'required|string|max:255',
            'budget_needed'  => 'required|numeric|min:0',
            'location_plan'  => 'required|string|max:255',
        ]);

        $constraint->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kendala berhasil diperbarui',
            'data'    => $constraint
        ], 200);
    }

    public function destroyConstraint($id): JsonResponse
    {
        $constraint = Constraint::find($id);

        if (!$constraint) {
            return response()->json(['status' => 'error', 'message' => 'Data kendala tidak ditemukan'], 404);
        }

        $constraint->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kendala berhasil dihapus'
        ], 200);
    }

    // ==========================================
    // 4. PENYEDIAAN ANGGARAN (BUDGET)
    // ==========================================

    public function getBudgets(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Data anggaran berhasil diambil',
            'data'    => Budget::latest()->get()
        ], 200);
    }

    public function storeBudget(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'indicator_id'         => 'required|string|max:255',
            'indicator_name'       => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount'               => 'required|numeric|min:0',
        ]);

        $budget = Budget::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data anggaran berhasil ditambahkan',
            'data'    => $budget
        ], 201);
    }

    public function updateBudget(Request $request, $id): JsonResponse
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['status' => 'error', 'message' => 'Data anggaran tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'indicator_id'         => 'required|string|max:255',
            'indicator_name'       => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount'               => 'required|numeric|min:0',
        ]);

        $budget->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data anggaran berhasil diperbarui',
            'data'    => $budget
        ], 200);
    }

    public function destroyBudget($id): JsonResponse
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['status' => 'error', 'message' => 'Data anggaran tidak ditemukan'], 404);
        }

        $budget->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data anggaran berhasil dihapus'
        ], 200);
    }

    // ==========================================
    // 5. CAPAIAN LAYANAN (SERVICE DATA)
    // ==========================================

    public function getServices(): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Data capaian layanan berhasil diambil',
            'data'    => ServiceData::latest()->get()
        ], 200);
    }

    public function storeService(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'birth_kia_count'    => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        $service = ServiceData::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data capaian layanan berhasil ditambahkan',
            'data'    => $service
        ], 201);
    }

    public function updateService(Request $request, $id): JsonResponse
    {
        $service = ServiceData::find($id);

        if (!$service) {
            return response()->json(['status' => 'error', 'message' => 'Data capaian layanan tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'birth_kia_count'    => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        $service->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data capaian layanan berhasil diperbarui',
            'data'    => $service
        ], 200);
    }

    public function destroyService($id): JsonResponse
    {
        $service = ServiceData::find($id);

        if (!$service) {
            return response()->json(['status' => 'error', 'message' => 'Data capaian layanan tidak ditemukan'], 404);
        }

        $service->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data capaian layanan berhasil dihapus'
        ], 200);
    }
}