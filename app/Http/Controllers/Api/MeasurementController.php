<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Measurement;
use App\Services\ZScoreCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Menyimpan data pengukuran baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => [
                'required',
                'exists:children,id'
            ],

            'measurement_date' => [
                'required',
                'date'
            ],

            'height' => [
                'required',
                'numeric',
                'min:30',
                'max:150'
            ],

            'weight' => [
                'required',
                'numeric',
                'min:1',
                'max:50'
            ],

            'head_circumference' => [
                'nullable',
                'numeric',
                'min:20',
                'max:70'
            ],
        ]);

        // Ambil data anak
        $child = Child::findOrFail($validated['child_id']);

        $birthDate = Carbon::parse($child->birth_date);
        $measurementDate = Carbon::parse(
            $validated['measurement_date']
        );

        // Pengukuran tidak boleh dilakukan sebelum anak lahir
        if ($measurementDate->lt($birthDate)) {
            return response()->json([
                'success' => false,
                'message' => 'Tanggal pengukuran tidak boleh sebelum tanggal lahir anak.',
            ], 422);
        }

        // Hitung umur dalam bulan
        $ageInMonths = (int) $birthDate->diffInMonths(
            $measurementDate
        );

        // Hitung Z-Score TB/U
        $zScoreData = ZScoreCalculator::calculateTB_U(
            $child->gender,
            $ageInMonths,
            $validated['height']
        );

        // Simpan pengukuran
        $measurement = Measurement::create([
            'child_id' => $child->id,
            'recorded_by' => $request->user()->id,
            'measurement_date' => $validated['measurement_date'],
            'age_in_months' => $ageInMonths,
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'head_circumference' =>
                $validated['head_circumference'] ?? null,
            'z_score_tb_u' => $zScoreData['z_score'],
            'stunting_status' => $zScoreData['status'],
        ]);

        // Load relasi anak jika tersedia
        $measurement->load('child');

        return response()->json([
            'success' => true,
            'message' => 'Pengukuran berhasil dicatat',
            'data' => $measurement,
        ], 201);
    }


    /**
     * Menampilkan seluruh pengukuran berdasarkan anak.
     */
    public function indexByChild($childId)
    {
        $child = Child::find($childId);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan',
            ], 404);
        }

        $measurements = Measurement::where(
                'child_id',
                $childId
            )
            ->latest('measurement_date')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat pengukuran berhasil diambil',
            'child' => $child,
            'data' => $measurements,
        ], 200);
    }


    /**
     * Menampilkan detail satu pengukuran.
     */
    public function show($id)
    {
        $measurement = Measurement::with([
            'child',
            'recordedBy'
        ])->find($id);

        if (!$measurement) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengukuran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail pengukuran berhasil diambil',
            'data' => $measurement,
        ], 200);
    }


    /**
     * Memperbarui data pengukuran.
     *
     * Z-Score dihitung ulang setelah data tinggi
     * atau tanggal pengukuran berubah.
     */
    public function update(Request $request, $id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengukuran tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'measurement_date' => [
                'sometimes',
                'required',
                'date'
            ],

            'height' => [
                'sometimes',
                'required',
                'numeric',
                'min:30',
                'max:150'
            ],

            'weight' => [
                'sometimes',
                'required',
                'numeric',
                'min:1',
                'max:50'
            ],

            'head_circumference' => [
                'nullable',
                'numeric',
                'min:20',
                'max:70'
            ],
        ]);

        $child = Child::findOrFail(
            $measurement->child_id
        );

        // Gunakan data lama jika tidak dikirim
        $measurementDate = Carbon::parse(
            $validated['measurement_date']
                ?? $measurement->measurement_date
        );

        $birthDate = Carbon::parse(
            $child->birth_date
        );

        if ($measurementDate->lt($birthDate)) {
            return response()->json([
                'success' => false,
                'message' => 'Tanggal pengukuran tidak boleh sebelum tanggal lahir anak.',
            ], 422);
        }

        // Hitung ulang umur
        $ageInMonths = (int) $birthDate->diffInMonths(
            $measurementDate
        );

        // Tinggi baru atau tinggi lama
        $height = $validated['height']
            ?? $measurement->height;

        // Hitung ulang Z-Score
        $zScoreData = ZScoreCalculator::calculateTB_U(
            $child->gender,
            $ageInMonths,
            $height
        );

        $measurement->update([
            'measurement_date' => $measurementDate,
            'age_in_months' => $ageInMonths,
            'height' => $height,
            'weight' => $validated['weight']
                ?? $measurement->weight,
            'head_circumference' =>
                array_key_exists(
                    'head_circumference',
                    $validated
                )
                    ? $validated['head_circumference']
                    : $measurement->head_circumference,
            'z_score_tb_u' => $zScoreData['z_score'],
            'stunting_status' => $zScoreData['status'],
        ]);

        $measurement->load('child');

        return response()->json([
            'success' => true,
            'message' => 'Data pengukuran berhasil diperbarui',
            'data' => $measurement,
        ], 200);
    }


    /**
     * Menghapus data pengukuran.
     */
    public function destroy($id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengukuran tidak ditemukan',
            ], 404);
        }

        $measurement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengukuran berhasil dihapus',
        ], 200);
    }


    /**
     * Statistik status stunting.
     */
    public function statistics(Request $request)
    {
        $query = Measurement::query();

        // Filter berdasarkan anak
        if ($request->filled('child_id')) {
            $query->where(
                'child_id',
                $request->child_id
            );
        }

        // Pengukuran terbaru setiap anak
        $latestMeasurements = Measurement::selectRaw(
            'MAX(id) as id'
        )
        ->when(
            $request->filled('child_id'),
            function ($q) use ($request) {
                $q->where(
                    'child_id',
                    $request->child_id
                );
            }
        )
        ->groupBy('child_id');

        $measurements = Measurement::whereIn(
            'id',
            $latestMeasurements
        )->get();

        $total = $measurements->count();

        $normal = $measurements
            ->where('stunting_status', 'Normal')
            ->count();

        $stunted = $measurements
            ->where('stunting_status', 'Stunted')
            ->count();

        $severelyStunted = $measurements
            ->where('stunting_status', 'Severely Stunted')
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Statistik stunting berhasil diambil',
            'data' => [
                'total_anak' => $total,
                'normal' => $normal,
                'stunted' => $stunted,
                'severely_stunted' => $severelyStunted,
            ],
        ], 200);
    }
}