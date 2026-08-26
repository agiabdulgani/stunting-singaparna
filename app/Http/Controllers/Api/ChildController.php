<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Ambil relasi yang benar-benar tersedia
     * pada Model Child.
     */
    private function getAvailableRelations(): array
    {
        return array_filter([
            'parent',
            'posyandu',
            'measurements'
        ], function ($relation) {
            return method_exists(Child::class, $relation);
        });
    }


    /**
     * Menampilkan daftar data anak.
     *
     * Filter yang tersedia:
     * - posyandu_id
     * - parent_id
     * - gender
     * - search (nama / NIK)
     */
    public function index(Request $request)
    {
        $query = Child::with($this->getAvailableRelations());

        // Filter Posyandu
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        // Filter orang tua
        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }

        // Filter jenis kelamin
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Pencarian nama atau NIK
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = min(
            max((int) $request->get('per_page', 20), 1),
            100
        );

        $children = $query
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Daftar data anak berhasil diambil',
            'data' => $children->items(),
            'pagination' => [
                'current_page' => $children->currentPage(),
                'last_page' => $children->lastPage(),
                'per_page' => $children->perPage(),
                'total' => $children->total(),
            ],
        ], 200);
    }


    /**
     * Menambahkan data anak.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => [
                'required',
                'exists:users,id'
            ],

            'posyandu_id' => [
                'required',
                'exists:posyandus,id'
            ],

            'nik' => [
                'required',
                'string',
                'max:20',
                'unique:children,nik'
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'gender' => [
                'required',
                'in:L,P'
            ],

            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
        ]);

        $child = Child::create($validated);

        // Load relasi jika tersedia
        $child->load($this->getAvailableRelations());

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil ditambahkan',
            'data' => $child,
        ], 201);
    }


    /**
     * Menampilkan detail satu anak.
     */
    public function show($id)
    {
        $child = Child::with(
            $this->getAvailableRelations()
        )->find($id);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data anak berhasil diambil',
            'data' => $child,
        ], 200);
    }


    /**
     * Memperbarui data anak.
     */
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
            'parent_id' => [
                'sometimes',
                'required',
                'exists:users,id'
            ],

            'posyandu_id' => [
                'sometimes',
                'required',
                'exists:posyandus,id'
            ],

            'nik' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                'unique:children,nik,' . $id
            ],

            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],

            'gender' => [
                'sometimes',
                'required',
                'in:L,P'
            ],

            'birth_date' => [
                'sometimes',
                'required',
                'date',
                'before_or_equal:today'
            ],
        ]);

        $child->update($validated);

        $child->load($this->getAvailableRelations());

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diperbarui',
            'data' => $child,
        ], 200);
    }


    /**
     * Menghapus data anak.
     */
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


    /**
     * Statistik data anak.
     *
     * Bisa digunakan untuk dashboard mobile.
     */
    public function statistics(Request $request)
    {
        $query = Child::query();

        // Filter berdasarkan Posyandu
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        $total = (clone $query)->count();

        $lakiLaki = (clone $query)
            ->where('gender', 'L')
            ->count();

        $perempuan = (clone $query)
            ->where('gender', 'P')
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Statistik data anak berhasil diambil',
            'data' => [
                'total_anak' => $total,
                'laki_laki' => $lakiLaki,
                'perempuan' => $perempuan,
            ],
        ], 200);
    }
}