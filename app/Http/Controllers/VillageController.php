<?php

namespace App\Http\Controllers;

use App\Exports\TargetDataExport;
use App\Models\Budget;
use App\Models\Constraint;
use App\Models\MbgData;
use App\Models\ServiceData;
use App\Models\SupportData;
use App\Models\TargetData;
use Barryvdh\DomPDF\Facade\Pdf as PDFFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class VillageController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard stunting.
     */
    public function index(): View
    {
        try {
            $targetData  = TargetData::latest()->get();
            $supportData = SupportData::latest()->get();
            $constraints = Constraint::latest()->get();
            $budgets     = Budget::latest()->get();
            $serviceData = ServiceData::latest()->get();
            $mbgData     = MbgData::latest()->get();
        } catch (Throwable $e) {
            // Jika ada tabel yang gagal dipanggil, fallback ke collection kosong agar halaman tidak blank/crash
            $targetData  = collect();
            $supportData = collect();
            $constraints = collect();
            $budgets     = collect();
            $serviceData = collect();
            $mbgData     = collect();
        }

        return view('dashboard', compact(
            'targetData',
            'supportData',
            'constraints',
            'budgets',
            'serviceData',
            'mbgData'
        ));
    }

    /**
     * Export seluruh data ke format PDF.
     */
    public function exportPdf()
    {
        $data = [
            'targetData'  => TargetData::latest()->get(),
            'supportData' => SupportData::latest()->get(),
            'constraints' => Constraint::latest()->get(),
            'budgets'     => Budget::latest()->get(),
            'serviceData' => ServiceData::latest()->get(),
            'mbgData'     => MbgData::latest()->get(),
        ];

        $pdf = PDFFacade::loadView('pdf.report', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_Stunting_Singaparna.pdf');
    }

    /**
     * Export data sasaran ke format Excel.
     */
    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new TargetDataExport, 'Data_Sasaran_Stunting.xlsx');
    }

    // ==========================================
    // 1. DATA SASARAN (TARGET DATA)
    // ==========================================

    public function storeTarget(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'population_count'   => 'required|integer|min:0',
            'family_count'       => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count'     => 'required|integer|min:0',
        ]);

        TargetData::create($validated);

        return back()->with('success', 'Data Sasaran berhasil ditambahkan!');
    }

    public function updateTarget(Request $request, TargetData $target): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'population_count'   => 'required|integer|min:0',
            'family_count'       => 'required|integer|min:0',
            'young_female_count' => 'required|integer|min:0',
            'children_count'     => 'required|integer|min:0',
        ]);

        $target->update($validated);

        return back()->with('success', 'Data Sasaran berhasil diperbarui!');
    }

    public function destroyTarget(TargetData $target): RedirectResponse
    {
        $target->delete();

        return back()->with('success', 'Data Sasaran berhasil dihapus!');
    }

    // ==========================================
    // 2. DATA PENDUKUNG (SUPPORT DATA)
    // ==========================================

    public function storeSupport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'           => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count'          => 'required|integer|min:0',
            'sma_ma_count'            => 'required|integer|min:0',
            'paud_teacher_count'     => 'required|integer|min:0',
        ]);

        SupportData::create($validated);

        return back()->with('success', 'Data Pendukung berhasil ditambahkan!');
    }

    public function updateSupport(Request $request, SupportData $support): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'           => 'required|string|max:255',
            'paud_institution_count' => 'required|integer|min:0',
            'smp_mts_count'          => 'required|integer|min:0',
            'sma_ma_count'            => 'required|integer|min:0',
            'paud_teacher_count'     => 'required|integer|min:0',
        ]);

        $support->update($validated);

        return back()->with('success', 'Data Pendukung berhasil diperbarui!');
    }

    public function destroySupport(SupportData $support): RedirectResponse
    {
        $support->delete();

        return back()->with('success', 'Data Pendukung berhasil dihapus!');
    }

    // ==========================================
    // 3. IDENTIFIKASI KENDALA (CONSTRAINT)
    // ==========================================

    public function storeConstraint(Request $request): RedirectResponse
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

        Constraint::create($validated);

        return back()->with('success', 'Data Kendala berhasil ditambahkan!');
    }

    public function updateConstraint(Request $request, Constraint $constraint): RedirectResponse
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

        $constraint->update($validated);

        return back()->with('success', 'Data Kendala berhasil diperbarui!');
    }

    public function destroyConstraint(Constraint $constraint): RedirectResponse
    {
        $constraint->delete();

        return back()->with('success', 'Data Kendala berhasil dihapus!');
    }

    // ==========================================
    // 4. PENYEDIAAN ANGGARAN (BUDGET)
    // ==========================================

    public function storeBudget(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'indicator_id'         => 'required|string|max:255',
            'indicator_name'       => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount'               => 'required|numeric|min:0',
        ]);

        Budget::create($validated);

        return back()->with('success', 'Data Anggaran berhasil ditambahkan!');
    }

    public function updateBudget(Request $request, Budget $budget): RedirectResponse
    {
        $validated = $request->validate([
            'indicator_id'         => 'required|string|max:255',
            'indicator_name'       => 'required|string|max:255',
            'activity_description' => 'required|string',
            'amount'               => 'required|numeric|min:0',
        ]);

        $budget->update($validated);

        return back()->with('success', 'Data Anggaran berhasil diperbarui!');
    }

    public function destroyBudget(Budget $budget): RedirectResponse
    {
        $budget->delete();

        return back()->with('success', 'Data Anggaran berhasil dihapus!');
    }

    // ==========================================
    // 5. DATA CAPAIAN LAYANAN (SERVICE DATA)
    // ==========================================

    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'birth_kia_count'    => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        ServiceData::create($validated);

        return back()->with('success', 'Data Capaian Layanan berhasil ditambahkan!');
    }

    public function updateService(Request $request, ServiceData $service): RedirectResponse
    {
        $validated = $request->validate([
            'village_name'       => 'required|string|max:255',
            'birth_kia_count'    => 'required|integer|min:0',
            'food_program_count' => 'required|integer|min:0',
        ]);

        $service->update($validated);

        return back()->with('success', 'Data Capaian Layanan berhasil diperbarui!');
    }

    public function destroyService(ServiceData $service): RedirectResponse
    {
        $service->delete();

        return back()->with('success', 'Data Capaian Layanan berhasil dihapus!');
    }

    // ==========================================
    // 6. MAKAN BERGIZI GRATIS (MBG DATA)
    // ==========================================

    public function storeMbg(Request $request): RedirectResponse
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

    public function updateMbg(Request $request, MbgData $mbg): RedirectResponse
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

    public function destroyMbg(MbgData $mbg): RedirectResponse
    {
        $mbg->delete();

        return back()->with('success', 'Data MBG berhasil dihapus!');
    }
}