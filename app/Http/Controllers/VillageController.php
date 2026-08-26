<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Constraint;
use App\Models\IndividualData;
use App\Models\MbgData;
use App\Models\ServiceData;
use App\Models\SupportData;
use App\Models\TargetData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VillageController extends Controller
{
    /**
     * Dashboard utama.
     *
     * Semua data dan semua TOTAL dihitung dari query yang sama,
     * sehingga dashboard.blade.php tetap sinkron dengan database.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | 1. QUERY DASAR
        |--------------------------------------------------------------------------
        */
        $targetQuery     = TargetData::query();
        $mbgQuery        = MbgData::query();
        $supportQuery    = SupportData::query();
        $individualQuery = IndividualData::query();
        $constraintQuery = Constraint::query();
        $serviceQuery    = ServiceData::query();
        $budgetQuery     = Budget::query();

        /*
        |--------------------------------------------------------------------------
        | 2. FILTER WILAYAH OPERATOR DESA
        |--------------------------------------------------------------------------
        | Semua modul yang memiliki village_name/nama_desa harus ikut difilter.
        */
        if ($user && $user->role === 'operator_desa' && filled($user->wilayah)) {
            $wilayah = trim($user->wilayah);

            $targetQuery->where('village_name', $wilayah);
            $mbgQuery->where('nama_desa', $wilayah);
            $supportQuery->where('village_name', $wilayah);
            $individualQuery->where('nama_desa', $wilayah);
            $constraintQuery->where('village_name', $wilayah);
            $serviceQuery->where('village_name', $wilayah);
            $budgetQuery->where('village_name', $wilayah);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. TOTAL DATA SASARAN
        |--------------------------------------------------------------------------
        | Dihitung SEBELUM paginate agar total tidak hanya berasal dari halaman 1.
        */
        $totalPopulation   = (int) $targetQuery->sum('population_count');
        $totalFamilies     = (int) $targetQuery->sum('family_count');
        $totalYoungFemales = (int) $targetQuery->sum('young_female_count');
        $totalChildren     = (int) $targetQuery->sum('children_count');
        $totalTargetRows   = (int) (clone $targetQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 4. TOTAL DATA PENDUKUNG
        |--------------------------------------------------------------------------
        */
        $totalPaud    = (int) $supportQuery->sum('paud_institution_count');
        $totalSmp     = (int) $supportQuery->sum('smp_mts_count');
        $totalSma     = (int) $supportQuery->sum('sma_ma_count');
        $totalGuruPaud = (int) $supportQuery->sum('paud_teacher_count');

        // Total sarana pendidikan = PAUD + SMP sederajat + SMA sederajat.
        $totalEducationFacilities = $totalPaud + $totalSmp + $totalSma;

        $totalSupportRows = (int) (clone $supportQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 5. TOTAL KENDALA
        |--------------------------------------------------------------------------
        */
        $totalConstraints = (int) (clone $constraintQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 6. TOTAL ANGGARAN
        |--------------------------------------------------------------------------
        */
        $totalBudget = (float) $budgetQuery->sum('amount');
        $totalBudgetRows = (int) (clone $budgetQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 7. TOTAL CAPAIAN LAYANAN
        |--------------------------------------------------------------------------
        */
        $totalBirthKia   = (int) $serviceQuery->sum('birth_kia_count');
        $totalFoodProgram = (int) $serviceQuery->sum('food_program_count');
        $totalService    = $totalBirthKia + $totalFoodProgram;
        $totalServiceRows = (int) (clone $serviceQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 8. TOTAL MBG
        |--------------------------------------------------------------------------
        */
        $totalMbgBalita = (int) $mbgQuery->sum('penerima_balita');
        $totalMbgBumil  = (int) $mbgQuery->sum('penerima_bumil');
        $totalMbgPaud   = (int) $mbgQuery->sum('penerima_paud');
        $totalMbgPorsi  = (int) $mbgQuery->sum('porsi_terdistribusi_harian');
        $totalMbgRows   = (int) (clone $mbgQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 9. TOTAL DATA INDIVIDU BALITA
        |--------------------------------------------------------------------------
        */
        $totalIndividuals = (int) (clone $individualQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | 10. DATA UNTUK TABEL
        |--------------------------------------------------------------------------
        | Target dan MBG tetap menggunakan pagination.
        | Modul lain menggunakan get() karena dashboard menampilkan total
        | dan tabel lengkap.
        */
        $targetData = (clone $targetQuery)
            ->latest()
            ->paginate(10, ['*'], 'target_page')
            ->withQueryString();

        $mbgData = (clone $mbgQuery)
            ->latest()
            ->paginate(10, ['*'], 'mbg_page')
            ->withQueryString();

        $supportData = (clone $supportQuery)
            ->latest()
            ->get();

        $serviceData = (clone $serviceQuery)
            ->latest()
            ->get();

        $constraints = (clone $constraintQuery)
            ->latest()
            ->get();

        $budgets = (clone $budgetQuery)
            ->latest()
            ->get();

        $individualData = (clone $individualQuery)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 11. KIRIM SEMUA DATA KE DASHBOARD.BLADE.PHP
        |--------------------------------------------------------------------------
        */
        return view('dashboard', [
            // Data tabel
            'targetData'     => $targetData,
            'supportData'    => $supportData,
            'constraints'    => $constraints,
            'budgets'        => $budgets,
            'serviceData'    => $serviceData,
            'mbgData'        => $mbgData,
            'individualData' => $individualData,

            // Total sasaran
            'totalPopulation'   => $totalPopulation,
            'totalFamilies'     => $totalFamilies,
            'totalYoungFemales' => $totalYoungFemales,
            'totalChildren'     => $totalChildren,
            'totalTargetRows'   => $totalTargetRows,

            // Total pendidikan
            'totalPaud'                 => $totalPaud,
            'totalSmp'                  => $totalSmp,
            'totalSma'                  => $totalSma,
            'totalGuruPaud'             => $totalGuruPaud,
            'totalEducationFacilities'  => $totalEducationFacilities,
            'totalSupportRows'          => $totalSupportRows,

            // Total kendala
            'totalConstraints' => $totalConstraints,

            // Total anggaran
            'totalBudget'    => $totalBudget,
            'totalBudgetRows' => $totalBudgetRows,

            // Total layanan
            'totalBirthKia'    => $totalBirthKia,
            'totalFoodProgram' => $totalFoodProgram,
            'totalService'     => $totalService,
            'totalServiceRows' => $totalServiceRows,

            // Total MBG
            'totalMbgBalita' => $totalMbgBalita,
            'totalMbgBumil'  => $totalMbgBumil,
            'totalMbgPaud'   => $totalMbgPaud,
            'totalMbgPorsi'  => $totalMbgPorsi,
            'totalMbgRows'   => $totalMbgRows,

            // Total individu
            'totalIndividuals' => $totalIndividuals,
        ]);
    }

    // =========================================================================
    // 1. DATA SASARAN
    // =========================================================================

    public function storeTarget(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'village_name'       => ['nullable', 'string', 'max:255'],
            'nama_desa'          => ['nullable', 'string', 'max:255'],
            'population_count'   => ['required', 'integer', 'min:0'],
            'family_count'       => ['required', 'integer', 'min:0'],
            'young_female_count' => ['required', 'integer', 'min:0'],
            'children_count'     => ['required', 'integer', 'min:0'],
        ]);

        $villageName = $this->resolveVillageName(
            $validated['village_name'] ?? null,
            $validated['nama_desa'] ?? null,
            $user
        );

        TargetData::create([
            'village_name'       => $villageName,
            'population_count'   => $validated['population_count'],
            'family_count'       => $validated['family_count'],
            'young_female_count' => $validated['young_female_count'],
            'children_count'     => $validated['children_count'],
        ]);

        return back()->with('success', 'Data Sasaran berhasil disimpan.');
    }

    public function destroyTarget(TargetData $target): RedirectResponse
    {
        $this->authorizeVillageAccess($target->village_name);

        $target->delete();

        return back()->with('success', 'Data Sasaran berhasil dihapus.');
    }

    // =========================================================================
    // 2. DATA PENDUKUNG
    // =========================================================================

    public function storeSupport(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'village_name' => ['nullable', 'string', 'max:255'],
            'nama_desa'    => ['nullable', 'string', 'max:255'],
            'jml_paud'     => ['required', 'integer', 'min:0'],
            'smp_mts'      => ['required', 'integer', 'min:0'],
            'sma_ma'       => ['required', 'integer', 'min:0'],
            'guru_paud'    => ['required', 'integer', 'min:0'],
        ]);

        $villageName = $this->resolveVillageName(
            $validated['village_name'] ?? null,
            $validated['nama_desa'] ?? null,
            $user
        );

        // FIX: menggunakan updateOrCreate agar data desa yang sudah ada
        // di-update, bukan membuat baris duplikat baru untuk desa yang sama.
        SupportData::updateOrCreate(
            ['village_name' => $villageName], // Kondisi pencarian (apakah desa sudah ada?)
            [
                'paud_institution_count' => $validated['jml_paud'],
                'smp_mts_count'          => $validated['smp_mts'],
                'sma_ma_count'           => $validated['sma_ma'],
                'paud_teacher_count'     => $validated['guru_paud'],
            ]
        );

        return back()->with('success', 'Data Pendukung berhasil disimpan.');
    }

    public function destroySupport(SupportData $support): RedirectResponse
    {
        $this->authorizeVillageAccess($support->village_name);

        $support->delete();

        return back()->with('success', 'Data Pendukung berhasil dihapus.');
    }

    // =========================================================================
    // 3. IDENTIFIKASI KENDALA
    // =========================================================================

    public function storeConstraint(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'village_name'   => ['nullable', 'string', 'max:255'],
            'nama_desa'      => ['nullable', 'string', 'max:255'],
            'problem'        => ['nullable', 'string'],
            'cause'          => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'assessment'     => ['nullable', 'string'],
            'location_plan'  => ['nullable', 'string'],
            'description'    => ['required', 'string'],
            'scope'          => ['nullable', 'string', 'max:255'],
        ]);

        $villageName = $this->resolveVillageName(
            $validated['village_name'] ?? null,
            $validated['nama_desa'] ?? null,
            $user
        );

        $description = $validated['description'];

        Constraint::create([
            'village_name'   => $villageName,
            'scope'          => $validated['scope'] ?? 'Umum',
            'problem'        => $validated['problem'] ?? $description,
            'cause'          => $validated['cause'] ?? '-',
            'recommendation' => $validated['recommendation'] ?? '-',
            'assessment'     => $validated['assessment'] ?? '-',
            'location_plan'  => $validated['location_plan'] ?? '-',
            'description'    => $description,
        ]);

        return back()->with('success', 'Data Kendala berhasil disimpan.');
    }

    public function destroyConstraint(Constraint $constraint): RedirectResponse
    {
        $this->authorizeVillageAccess($constraint->village_name);

        $constraint->delete();

        return back()->with('success', 'Data Kendala berhasil dihapus.');
    }

    // =========================================================================
    // 4. CAPAIAN LAYANAN
    // =========================================================================

    public function storeService(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'village_name'       => ['nullable', 'string', 'max:255'],
            'birth_kia_count'    => ['required', 'integer', 'min:0'],
            'food_program_count' => ['required', 'integer', 'min:0'],
        ]);

        $villageName = $this->resolveVillageName(
            $validated['village_name'] ?? null,
            null,
            $user
        );

        ServiceData::create([
            'village_name'       => $villageName,
            'birth_kia_count'    => $validated['birth_kia_count'],
            'food_program_count' => $validated['food_program_count'],
        ]);

        return back()->with('success', 'Data Layanan berhasil disimpan.');
    }

    public function destroyService(ServiceData $service): RedirectResponse
    {
        $this->authorizeVillageAccess($service->village_name);

        $service->delete();

        return back()->with('success', 'Data Layanan berhasil dihapus.');
    }

    // =========================================================================
    // 5. PENYEDIAAN ANGGARAN
    // =========================================================================

    public function storeBudget(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'village_name'         => ['nullable', 'string', 'max:255'],
            'indicator_name'       => ['required', 'string', 'max:255'],
            'amount'               => ['required', 'numeric', 'min:0'],
            'activity_description' => ['required', 'string'],
        ]);

        $villageName = $this->resolveVillageName(
            $validated['village_name'] ?? null,
            null,
            $user
        );

        Budget::create([
            'village_name'         => $villageName,
            'indicator_id'         => 1,
            'indicator_name'       => $validated['indicator_name'],
            'amount'               => $validated['amount'],
            'activity_description' => $validated['activity_description'],
        ]);

        return back()->with('success', 'Data Anggaran berhasil disimpan.');
    }

    public function destroyBudget(Budget $budget): RedirectResponse
    {
        $this->authorizeVillageAccess($budget->village_name);

        $budget->delete();

        return back()->with('success', 'Data Anggaran berhasil dihapus.');
    }

    // =========================================================================
    // 6. MAKAN BERGIZI GRATIS (MBG)
    // =========================================================================

  public function storeMbg(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_desa'                  => ['nullable', 'string', 'max:255'],
            'penerima_balita'            => ['required', 'integer', 'min:0'],
            'penerima_bumil'             => ['required', 'integer', 'min:0'],
            'penerima_paud'              => ['required', 'integer', 'min:0'],
            'porsi_terdistribusi_harian' => ['required', 'integer', 'min:0'],
        ]);

        $villageName = $this->resolveVillageName(
            null,
            $validated['nama_desa'] ?? null,
            $user
        );

        MbgData::create([
            'nama_desa'                  => $villageName,
            'penerima_balita'            => $validated['penerima_balita'],
            'penerima_bumil'             => $validated['penerima_bumil'],
            'penerima_paud'              => $validated['penerima_paud'],
            'porsi_terdistribusi_harian' => $validated['porsi_terdistribusi_harian'],
        ]);

        return back()->with('success', 'Data MBG berhasil disimpan.');
    }

    public function destroyMbg(MbgData $mbg): RedirectResponse
    {
        $this->authorizeVillageAccess($mbg->nama_desa);

        $mbg->delete();

        return back()->with('success', 'Data MBG berhasil dihapus.');
    }

    // =========================================================================
    // 7. DATA INDIVIDU BALITA
    // =========================================================================

    public function storeIndividual(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_desa'    => ['nullable', 'string', 'max:255'],
            'nama_anak'    => ['required', 'string', 'max:255'],
            'umur_bulan'   => ['required', 'integer', 'min:0'],
            'tinggi_badan' => ['required', 'numeric', 'min:0'],
            'berat_badan'  => ['required', 'numeric', 'min:0'],
            'alamat'       => ['required', 'string'],
        ]);

        $villageName = $this->resolveVillageName(
            null,
            $validated['nama_desa'] ?? null,
            $user
        );

        IndividualData::create([
            'nama_desa'    => $villageName,
            'nama_anak'    => $validated['nama_anak'],
            'umur_bulan'   => $validated['umur_bulan'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'berat_badan'  => $validated['berat_badan'],
            'alamat'       => $validated['alamat'],
        ]);

        return back()->with('success', 'Data Individu Balita berhasil disimpan.');
    }

    public function destroyIndividual(IndividualData $individual): RedirectResponse
    {
        $this->authorizeVillageAccess($individual->nama_desa);

        $individual->delete();

        return back()->with('success', 'Data Individu Balita berhasil dihapus.');
    }

    // =========================================================================
    // HELPER
    // =========================================================================

    /**
     * Menentukan nama wilayah dengan aman.
     *
     * Untuk operator_desa, wilayah akun diprioritaskan agar operator
     * tidak bisa memasukkan data ke desa lain dari form dashboard.
     */
    private function resolveVillageName(
        ?string $villageName,
        ?string $namaDesa,
        $user
    ): string {
        if ($user && $user->role === 'operator_desa' && filled($user->wilayah)) {
            return trim($user->wilayah);
        }

        $name = $villageName ?: $namaDesa ?: ($user->wilayah ?? 'Singaparna');

        return trim($name);
    }

    /**
     * Memastikan operator desa hanya dapat menghapus data wilayahnya sendiri,
     * dan memastikan hanya role 'admin' yang boleh menghapus data.
     *
     * Kader hanya boleh melihat dan input data, tidak boleh menghapus.
     * Pengecekan ini di sisi server, jadi tetap aman walau tombol hapus
     * di Blade sudah disembunyikan untuk kader.
     */
    private function authorizeVillageAccess(?string $villageName): void
    {
        $user = auth()->user();

        if ($user && $user->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus data.');
        }

        if (
            $user &&
            $user->role === 'operator_desa' &&
            filled($user->wilayah) &&
            trim((string) $villageName) !== trim((string) $user->wilayah)
        ) {
            abort(403, 'Anda tidak memiliki akses ke data wilayah tersebut.');
        }
    }
}