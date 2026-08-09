<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Ambil relasi yang benar-benar ada pada Model Child
     */
    private function getAvailableRelations(): array
    {
        return array_filter(['parent', 'posyandu', 'measurements'], function ($relation) {
            return method_exists(Child::class, $relation);
        });
    }

    public function index(Request $request)
    {
        $query = Child::with($this->getAvailableRelations());

        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        $children = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data anak berhasil diambil',
            'data'    => $children,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id'   => 'required|exists:users,id',
            'posyandu_id' => 'required|exists:posyandus,id',
            'nik'         => 'required|string|unique:children,nik',
            'name'        => 'required|string|max:255',
            'gender'      => 'required|in:L,P',
            'birth_date'  => 'required|date',
        ]);

        $child = Child::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil ditambahkan',
            'data'    => $child,
        ], 201);
    }

    public function show($id)
    {
        $child = Child::with($this->getAvailableRelations())->find($id);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $child,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $child = Child::find($id);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'parent_id'   => 'sometimes|required|exists:users,id',
            'posyandu_id' => 'sometimes|required|exists:posyandus,id',
            'nik'         => 'sometimes|required|string|unique:children,nik,' . $id,
            'name'        => 'sometimes|required|string|max:255',
            'gender'      => 'sometimes|required|in:L,P',
            'birth_date'  => 'sometimes|required|date',
        ]);

        $child->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diperbarui',
            'data'    => $child,
        ], 200);
    }

    public function destroy($id)
    {
        $child = Child::find($id);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan',
            ], 404);
        }

        $child->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil dihapus',
        ], 200);
    }
}