<?php

namespace App\Http\Controllers;

use App\Models\MbgData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MbgController extends Controller
{
    /**
     * Simpan data Makan Bergizi Gratis (MBG) baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_desa'                  => 'required|string|max:255',
            'penerima_balita'            => 'required|integer|min:0',
            'penerima_bumil'             => 'required|integer|min:0',
            'penerima_paud'              => 'required|integer|min:0',
            'porsi_terdistribusi_harian' => 'required|integer|min:0',
            'status_layanan'             => 'required|string|max:255',
            'catatan_dapur'              => 'nullable|string',
        ]);

        MbgData::create($validated);

        return back()->with('success', 'Data MBG berhasil ditambahkan!');
    }

    /**
     * Perbarui data Makan Bergizi Gratis (MBG).
     */
    public function update(Request $request, MbgData $mbg): RedirectResponse
    {
        $validated = $request->validate([
            'nama_desa'                  => 'required|string|max:255',
            'penerima_balita'            => 'required|integer|min:0',
            'penerima_bumil'             => 'required|integer|min:0',
            'penerima_paud'              => 'required|integer|min:0',
            'porsi_terdistribusi_harian' => 'required|integer|min:0',
            'status_layanan'             => 'required|string|max:255',
            'catatan_dapur'              => 'nullable|string',
        ]);

        $mbg->update($validated);

        return back()->with('success', 'Data MBG berhasil diperbarui!');
    }

    /**
     * Hapus data Makan Bergizi Gratis (MBG).
     */
    public function destroy(MbgData $mbg): RedirectResponse
    {
        $mbg->delete();

        return back()->with('success', 'Data MBG berhasil dihapus!');
    }
}