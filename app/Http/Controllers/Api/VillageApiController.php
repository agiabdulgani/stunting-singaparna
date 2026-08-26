<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TargetData;
use App\Models\SupportData;
use App\Models\Constraint;
use App\Models\Budget;
use App\Models\ServiceData;
use App\Models\Child;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VillageApiController extends Controller
{
    // ==========================================
    // 0. DASHBOARD / OVERVIEW
    // ==========================================

    /**
     * GET /api/dashboard
     *
     * Ringkasan data untuk Mobile App.
     */
    public function dashboard(): JsonResponse
    {
        $latestMeasurements = Measurement::with('child')
            ->latest('measurement_date')
            ->get()
            ->unique('child_id')
            ->values();

        $totalChildren = Child::count();

        $normal = $latestMeasurements
            ->where('stunting_status', 'Normal')
            ->count();

        $stunted = $latestMeasurements
            ->where('stunting_status', 'Stunted')
            ->count();

        $severelyStunted = $latestMeasurements
            ->where('stunting_status', 'Severely Stunted')
            ->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Ringkasan data stunting berhasil diambil',

            'data' => [

                // Statistik utama
                'statistics' => [
                    'total_children' => $totalChildren,
                    'normal' => $normal,
                    'stunted' => $stunted,
                    'severely_stunted' => $severelyStunted,
                ],

                // 5 modul utama
                'target_data' => TargetData::latest()->get(),

                'support_data' => SupportData::latest()->get(),

                'constraints' => Constraint::latest()->get(),

                'budgets' => Budget::latest()->get(),

                'service_data' => ServiceData::latest()->get(),
            ]
        ], 200);
    }


    // ==========================================
    // 0.1 STATISTIK DASHBOARD
    // ==========================================

    /**
     * GET /api/statistics
     */
    public function statistics(): JsonResponse
    {
        $latestMeasurements = Measurement::latest('measurement_date')
            ->get()
            ->unique('child_id');

        return response()->json([
            'status' => 'success',
            'message' => 'Statistik berhasil diambil',

            'data' => [
                'total_children' => Child::count(),

                'total_targets' => TargetData::count(),

                'total_supports' => SupportData::count(),

                'total_constraints' => Constraint::count(),

                'total_budgets' => Budget::count(),

                'total_services' => ServiceData::count(),

                'normal' => $latestMeasurements
                    ->where('stunting_status', 'Normal')
                    ->count(),

                'stunted' => $latestMeasurements
                    ->where('stunting_status', 'Stunted')
                    ->count(),

                'severely_stunted' => $latestMeasurements
                    ->where('stunting_status', 'Severely Stunted')
                    ->count(),
            ]
        ], 200);
    }


    // ==========================================
    // 1. DATA SASARAN
    // ==========================================

    /**
     * GET /api/targets
     */
    public function getTargets(Request $request): JsonResponse
    {
        $query = TargetData::query();

        if ($request->filled('search')) {
            $query->where(
                'village_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $targets = $query
            ->latest()
            ->paginate(
                min(max((int) $request->get('per_page', 20), 1), 100)
            );

        return response()->json([
            'status' => 'success',
            'message' => 'Data sasaran berhasil diambil',
            'data' => $targets->items(),
            'pagination' => [
                'current_page' => $targets->currentPage(),
                'last_page' => $targets->lastPage(),
                'per_page' => $targets->perPage(),
                'total' => $targets->total(),
            ]
        ], 200);
    }


    /**
     * GET /api/targets/{id}
     */
    public function showTarget($id): JsonResponse
    {
        $target = TargetData::find($id);

        if (!$target) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data sasaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data sasaran berhasil diambil',
            'data' => $target
        ], 200);
    }


    /**
     * POST /api/targets
     */
    public function storeTarget(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'population_count' => 'required|integer|min:0',
            'family_count' => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count' => 'required|integer|min:0',
        ]);

        $target = TargetData::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data sasaran berhasil ditambahkan',
            'data' => $target
        ], 201);
    }


    /**
     * PUT /api/targets/{id}
     */
    public function updateTarget(Request $request, $id): JsonResponse
    {
        $target = TargetData::find($id);

        if (!$target) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data sasaran tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'population_count' => 'required|integer|min:0',
            'family_count' => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count' => 'required|integer|min:0',
        ]);

        $target->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data sasaran berhasil diperbarui',
            'data' => $target->fresh()
        ], 200);
    }


    /**
     * DELETE /api/targets/{id}
     */
    public function destroyTarget($id): JsonResponse
    {
        $target = TargetData::find($id);

        if (!$target) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data sasaran tidak ditemukan'
            ], 404);
        }

        $target->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data sasaran berhasil dihapus'
        ], 200);
    }


    // ==========================================
    // 2. DATA PENDUKUNG
    // ==========================================

    /**
     * GET /api/supports
     */
    public function getSupports(Request $request): JsonResponse
    {
        $query = SupportData::query();

        if ($request->filled('search')) {
            $query->where(
                'village_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $supports = $query
            ->latest()
            ->paginate(
                min(max((int) $request->get('per_page', 20), 1), 100)
            );

        return response()->json([
            'status' => 'success',
            'message' => 'Data pendukung berhasil diambil',
            'data' => $supports->items(),
            'pagination' => [
                'current_page' => $supports->currentPage(),
                'last_page' => $supports->lastPage(),
                'per_page' => $supports->perPage(),
                'total' => $supports->total(),
            ]
        ], 200);
    }


    /**
     * GET /api/supports/{id}
     */
    public function showSupport($id): JsonResponse
    {
        $support = SupportData::find($id);

        if (!$support) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pendukung tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data pendukung berhasil diambil',
            'data' => $support
        ], 200);
    }


    public function storeSupport(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count' => 'required|integer|min:0',
            'sma_ma_count' => 'required|integer|min:0',
            'paud_teacher_count' => 'required|integer|min:0',
        ]);

        $support = SupportData::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pendukung berhasil ditambahkan',
            'data' => $support
        ], 201);
    }


    public function updateSupport(Request $request, $id): JsonResponse
    {
        $support = SupportData::find($id);

        if (!$support) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pendukung tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count' => 'required|integer|min:0',
            'sma_ma_count' => 'required|integer|min:0',
            'paud_teacher_count' => 'required|integer|min:0',
        ]);

        $support->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pendukung berhasil diperbarui',
            'data' => $support->fresh()
        ], 200);
    }


    public function destroySupport($id): JsonResponse
    {
        $support = SupportData::find($id);

        if (!$support) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pendukung tidak ditemukan'
            ], 404);
        }

        $support->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pendukung berhasil dihapus'
        ], 200);
    }


    // ==========================================
    // 3. CONSTRAINT
    // ==========================================

    public function getConstraints(Request $request): JsonResponse
    {
        $query = Constraint::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where(
                    'scope',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'problem',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        $constraints = $query
            ->latest()
            ->paginate(
                min(max((int) $request->get('per_page', 20), 1), 100)
            );

        return response()->json([
            'status' => 'success',
            'message' => 'Data kendala berhasil diambil',
            'data' => $constraints->items(),
            'pagination' => [
                'current_page' => $constraints->currentPage(),
                'last_page' => $constraints->lastPage(),
                'per_page' => $constraints->perPage(),
                'total' => $constraints->total(),
            ]
        ], 200);
    }


    public function showConstraint($id): JsonResponse
    {
        $constraint = Constraint::find($id);

        if (!$constraint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kendala tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data kendala berhasil diambil',
            'data' => $constraint
        ], 200);
    }


    public function storeConstraint(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'scope' => 'required|string|max:255',
            'problem' => 'required|string',
            'cause' => 'required|string',
            'recommendation' => 'required|string',
            'assessment' => 'required|string|max:255',
            'budget_needed' => 'required|numeric|min:0',
            'location_plan' => 'required|string|max:255',
        ]);

        $constraint = Constraint::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kendala berhasil ditambahkan',
            'data' => $constraint
        ], 201);
    }


    public function updateConstraint(Request $request, $id): JsonResponse
    {
        $constraint = Constraint::find($id);

        if (!$constraint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kendala tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'scope' => 'required|string|max:255',
            'problem' => 'required|string',
            'cause' => 'required|string',
            'recommendation' => 'required|string',
            'assessment' => 'required|string|max:255',
            'budget_needed' => 'required|numeric|min:0',
            'location_plan' => 'required|string|max:255',
        ]);

        $constraint->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kendala berhasil diperbarui',
            'data' => $constraint->fresh()
        ], 200);
    }


    public function destroyConstraint($id): JsonResponse
    {
        $constraint = Constraint::find($id);

        if (!$constraint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kendala tidak ditemukan'
            ], 404);
        }

        $constraint->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data kendala berhasil dihapus'
        ], 200);
    }


    // ==========================================
    // 4. BUDGET
    // ==========================================

    public function getBudgets(Request $request): JsonResponse
    {
        $query = Budget::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where(
                    'indicator_id',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'indicator_name',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        $budgets = $query
            ->latest()
            ->paginate(
                min(max((int) $request->get('per_page', 20), 1), 100)
            );

        return response()->json([
            'status' => 'success',
            'message' => 'Data anggaran berhasil diambil',
            'data' => $budgets->items(),
            'pagination' => [
                'current_page' => $budgets->currentPage(),
                'last_page' => $budgets->lastPage(),
                'per_page' => $budgets->perPage(),
                'total' => $budgets->total(),
            ]
        ], 200);
    }


    public function showBudget($id): JsonResponse
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data anggaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data anggaran berhasil diambil',
            'data' => $budget
        ], 200);
    }


    public function storeBudget(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'indicator_id' => 'required|string|max:255',
            'indicator_name' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $budget = Budget::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data anggaran berhasil ditambahkan',
            'data' => $budget
        ], 201);
    }


    public function updateBudget(Request $request, $id): JsonResponse
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data anggaran tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'indicator_id' => 'required|string|max:255',
            'indicator_name' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $budget->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data anggaran berhasil diperbarui',
            'data' => $budget->fresh()
        ], 200);
    }


    public function destroyBudget($id): JsonResponse
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data anggaran tidak ditemukan'
            ], 404);
        }

        $budget->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data anggaran berhasil dihapus'
        ], 200);
    }


    // ==========================================
    // 5. CAPAIAN LAYANAN
    // ==========================================

    public function getServices(Request $request): JsonResponse
    {
        $query = ServiceData::query();

        if ($request->filled('search')) {
            $query->where(
                'village_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $services = $query
            ->latest()
            ->paginate(
                min(max((int) $request->get('per_page', 20), 1), 100)
            );

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian layanan berhasil diambil',
            'data' => $services->items(),
            'pagination' => [
                'current_page' => $services->currentPage(),
                'last_page' => $services->lastPage(),
                'per_page' => $services->perPage(),
                'total' => $services->total(),
            ]
        ], 200);
    }


    public function showService($id): JsonResponse
    {
        $service = ServiceData::find($id);

        if (!$service) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data capaian layanan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data capaian layanan berhasil diambil',
            'data' => $service
        ], 200);
    }


    public function storeService(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'birth_kia_count' => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        $service = ServiceData::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian layanan berhasil ditambahkan',
            'data' => $service
        ], 201);
    }


    public function updateService(Request $request, $id): JsonResponse
    {
        $service = ServiceData::find($id);

        if (!$service) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data capaian layanan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'village_name' => 'required|string|max:255',
            'birth_kia_count' => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        $service->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian layanan berhasil diperbarui',
            'data' => $service->fresh()
        ], 200);
    }


    public function destroyService($id): JsonResponse
    {
        $service = ServiceData::find($id);

        if (!$service) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data capaian layanan tidak ditemukan'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian layanan berhasil dihapus'
        ], 200);
    }
}