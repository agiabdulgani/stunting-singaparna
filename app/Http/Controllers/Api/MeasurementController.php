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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'measurement_date' => 'required|date',
            'height' => 'required|numeric|min:30|max:150',
            'weight' => 'required|numeric|min:1|max:50',
            'head_circumference' => 'nullable|numeric',
        ]);

        $child = Child::findOrFail($validated['child_id']);

        // Hitung umur dalam bulan berdasarkan tanggal lahir & tanggal ukur
        $birthDate = Carbon::parse($child->birth_date);
        $measurementDate = Carbon::parse($validated['measurement_date']);
        $ageInMonths = (int) $birthDate->diffInMonths($measurementDate);

        // Kalkulasi Z-Score WHO (TB/U)
        $zScoreData = ZScoreCalculator::calculateTB_U(
            $child->gender,
            $ageInMonths,
            $validated['height']
        );

        $measurement = Measurement::create([
            'child_id' => $child->id,
            'recorded_by' => $request->user()->id,
            'measurement_date' => $validated['measurement_date'],
            'age_in_months' => $ageInMonths,
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'head_circumference' => $validated['head_circumference'] ?? null,
            'z_score_tb_u' => $zScoreData['z_score'],
            'stunting_status' => $zScoreData['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengukuran berhasil dicatat',
            'data' => $measurement,
        ], 201);
    }

    public function indexByChild($childId)
    {
        $measurements = Measurement::where('child_id', $childId)
            ->latest('measurement_date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $measurements,
        ]);
    }
}