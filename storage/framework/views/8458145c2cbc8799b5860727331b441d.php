<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Stunting Singaparna - Sistem Informasi Monitoring & Identifikasi Stunting</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #4e54c8;
            --primary-light: #8f94fb;
            --bg: #f4f6f9;
            --text: #212529;
            --muted: #6c757d;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .header-bg {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 24px 0;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
            box-shadow: 0 6px 20px rgba(0,0,0,.12);
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(255,255,255,.16);
            margin-right: 12px;
        }

        .card-stat,
        .content-card {
            border: 0;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(0,0,0,.06);
        }

        .card-stat {
            min-height: 125px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 9px 24px rgba(0,0,0,.10);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .nav-pills {
            overflow-x: auto;
            flex-wrap: nowrap !important;
            padding-bottom: 3px;
        }

        .nav-pills .nav-link {
            color: #495057;
            font-weight: 600;
            border-radius: 10px;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .nav-pills .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(78,84,200,.30);
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .section-subtitle {
            color: var(--muted);
            font-size: .88rem;
        }

        .table-responsive {
            border-radius: 12px;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            white-space: nowrap;
            font-size: .9rem;
        }

        .table tbody td {
            font-size: .92rem;
        }

        .table tfoot th,
        .table tfoot td {
            white-space: nowrap;
        }

        .number-cell {
            font-variant-numeric: tabular-nums;
            font-weight: 600;
        }

        .action-cell {
            min-width: 80px;
        }

        .toolbar {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 12px;
        }

        .empty-state {
            padding: 32px 15px !important;
            color: #6c757d;
            text-align: center;
        }

        .badge-soft {
            padding: .45rem .65rem;
            border-radius: 999px;
            font-weight: 600;
        }

        .sticky-summary {
            position: sticky;
            top: 12px;
            z-index: 10;
        }

        .back-to-top {
            position: fixed;
            right: 20px;
            bottom: 20px;
            display: none;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,.18);
            z-index: 1000;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(78,84,200,.15);
        }

        .pagination {
            margin-bottom: 0;
            margin-top: 15px;
        }

        @media (max-width: 767.98px) {
            .header-bg { padding: 18px 0; }
            .header-bg .container { align-items: flex-start !important; }
            .logout-text { display: none; }
            .card-stat { min-height: 110px; }
            .stat-value { font-size: 1.35rem; }
        }

        @media print {
            body { background: #fff; }
            .no-print,
            .nav-pills,
            .btn,
            form,
            .toolbar,
            .pagination,
            .back-to-top,
            .action-cell,
            .header-bg form {
                display: none !important;
            }

            .header-bg {
                color: #000 !important;
                background: #fff !important;
                box-shadow: none;
                border-bottom: 1px solid #ddd;
            }

            .content-card,
            .card-stat {
                box-shadow: none;
                border: 1px solid #ddd;
                break-inside: avoid;
            }

            .tab-pane {
                display: block !important;
                opacity: 1 !important;
            }

            .tab-pane:not(.active) {
                display: block !important;
            }

            .table-responsive {
                overflow: visible !important;
            }
        }
    </style>
</head>

<body>

<?php
    // Default collection agar Blade tetap aman ketika suatu variabel belum dikirim Controller.
    $targetData = $targetData ?? collect();
    $supportData = $supportData ?? collect();
    $constraints = $constraints ?? collect();
    $budgets = $budgets ?? collect();
    $serviceData = $serviceData ?? collect();
    $mbgData = $mbgData ?? collect();
    $individualData = $individualData ?? collect();

    /*
     * Semua variabel utama dibuat aman jika Controller belum mengirimkan data.
     * Jika data berbentuk paginator, items() dipakai untuk isi halaman saat ini.
     */
    $targetRows = isset($targetData)
        ? (method_exists($targetData, 'items') ? collect($targetData->items()) : collect($targetData))
        : collect();

    $supportRows = isset($supportData)
        ? (method_exists($supportData, 'items') ? collect($supportData->items()) : collect($supportData))
        : collect();

    $constraintRows = isset($constraints)
        ? (method_exists($constraints, 'items') ? collect($constraints->items()) : collect($constraints))
        : collect();

    $budgetRows = isset($budgets)
        ? (method_exists($budgets, 'items') ? collect($budgets->items()) : collect($budgets))
        : collect();

    $serviceRows = isset($serviceData)
        ? (method_exists($serviceData, 'items') ? collect($serviceData->items()) : collect($serviceData))
        : collect();

    $mbgRows = isset($mbgData)
        ? (method_exists($mbgData, 'items') ? collect($mbgData->items()) : collect($mbgData))
        : collect();

    $individualRows = isset($individualData)
        ? (method_exists($individualData, 'items') ? collect($individualData->items()) : collect($individualData))
        : collect();

    /*
     * Jika Controller nanti menyediakan nilai agregat global, Blade akan
     * menggunakannya. Jika belum ada, Blade menggunakan data yang tersedia.
     */
    $populationTotal = $totalPopulation ?? $targetRows->sum(fn($row) => (int) ($row->population_count ?? 0));
    $familyTotal = $totalFamily ?? $targetRows->sum(fn($row) => (int) ($row->family_count ?? 0));
    $youngFemaleTotal = $totalYoungFemale ?? $targetRows->sum(fn($row) => (int) ($row->young_female_count ?? 0));
    $childrenTotal = $totalChildren ?? $targetRows->sum(fn($row) => (int) ($row->children_count ?? 0));

    $paudTotal = $totalPaud ?? $supportRows->sum(fn($row) => (int) ($row->jml_paud ?? 0));
    $smpTotal = $totalSmp ?? $supportRows->sum(fn($row) => (int) ($row->smp_mts ?? 0));
    $smaTotal = $totalSma ?? $supportRows->sum(fn($row) => (int) ($row->sma_ma ?? 0));
    $guruPaudTotal = $totalGuruPaud ?? $supportRows->sum(fn($row) => (int) ($row->guru_paud ?? 0));
    $educationTotal = $paudTotal + $smpTotal + $smaTotal;

    $constraintTotal = $totalConstraints ?? (is_object($constraints) && method_exists($constraints, 'total') ? $constraints->total() : $constraintRows->count());

    $budgetTotal = $totalBudget ?? $budgetRows->sum(fn($row) => (float) ($row->amount ?? 0));

    $kiaTotal = $totalKia ?? $serviceRows->sum(fn($row) => (int) ($row->birth_kia_count ?? 0));
    $foodTotal = $totalFoodProgram ?? $serviceRows->sum(fn($row) => (int) ($row->food_program_count ?? 0));
    $serviceTotal = $kiaTotal + $foodTotal;

    $mbgBalitaTotal = $totalMbgBalita ?? $mbgRows->sum(fn($row) => (int) ($row->penerima_balita ?? 0));
    $mbgBumilTotal = $totalMbgBumil ?? $mbgRows->sum(fn($row) => (int) ($row->penerima_bumil ?? 0));
    $mbgPaudTotal = $totalMbgPaud ?? $mbgRows->sum(fn($row) => (int) ($row->penerima_paud ?? 0));
    $mbgPortionTotal = $totalMbgPortion ?? $mbgRows->sum(fn($row) => (int) ($row->porsi_terdistribusi_harian ?? 0));

    $individualTotal = $totalIndividual ?? (
        is_object($individualData) && method_exists($individualData, 'total')
            ? $individualData->total()
            : $individualRows->count()
    );
?>

<!-- HEADER -->
<header class="header-bg mb-4">
    <div class="container d-flex justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center">
            <div class="brand-icon">
                <i class="fa-solid fa-child-reaching fa-xl text-warning"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1">Stunting Singaparna</h3>
                <p class="mb-0 text-white-50">Sistem Informasi Monitoring & Identifikasi Stunting</p>
            </div>
        </div>

        <div class="d-flex gap-2 no-print">
            <button type="button" class="btn btn-light fw-bold shadow-sm" onclick="printDashboard()">
                <i class="fa-solid fa-print me-1"></i>
                <span class="logout-text">Cetak</span>
            </button>

            <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-light text-danger fw-bold shadow-sm">
                    <i class="fa-solid fa-right-from-bracket me-1"></i>
                    <span class="logout-text">Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>

<main class="container pb-5">

    <!-- NOTIFIKASI -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm no-print" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm no-print" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger shadow-sm no-print">
            <strong><i class="fa-solid fa-triangle-exclamation me-1"></i> Data belum dapat disimpan.</strong>
            <ul class="mb-0 mt-2">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- RINGKASAN UTAMA -->
    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <div>
                <h4 class="section-title">Ringkasan Dashboard</h4>
                <div class="section-subtitle">Rekapitulasi data monitoring stunting.</div>
            </div>
            <div class="no-print">
                <span class="badge bg-light text-dark border">
                    <i class="fa-regular fa-clock me-1"></i>
                    <span id="currentDateTime">-</span>
                </span>
            </div>
        </div>

        <div class="row g-3">
            <!-- Penduduk -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-primary-subtle text-primary mx-auto">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-muted small fw-bold">TOTAL PENDUDUK</div>
                    <div class="stat-value fs-3 fw-bold text-primary mt-1">
                        <?php echo e(number_format($populationTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted">KK: <?php echo e(number_format($familyTotal, 0, ',', '.')); ?></small>
                </div>
            </div>

            <!-- Pendidikan -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-success-subtle text-success mx-auto">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="text-muted small fw-bold">SARANA PENDIDIKAN</div>
                    <div class="stat-value fs-3 fw-bold text-success mt-1">
                        <?php echo e(number_format($educationTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted">
                        PAUD <?php echo e($paudTotal); ?> · SMP <?php echo e($smpTotal); ?> · SMA <?php echo e($smaTotal); ?>

                    </small>
                </div>
            </div>

            <!-- Kendala -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-warning-subtle text-warning mx-auto">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="text-muted small fw-bold">KENDALA</div>
                    <div class="stat-value fs-3 fw-bold text-warning mt-1">
                        <?php echo e(number_format($constraintTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted">identifikasi kendala</small>
                </div>
            </div>

            <!-- Anggaran -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-info-subtle text-info mx-auto">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div class="text-muted small fw-bold">TOTAL ANGGARAN</div>
                    <div class="fw-bold text-info mt-2" style="font-size:1.2rem;">
                        Rp <?php echo e(number_format($budgetTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted"><?php echo e($budgetRows->count()); ?> data</small>
                </div>
            </div>

            <!-- Layanan -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-secondary-subtle text-secondary mx-auto">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="text-muted small fw-bold">CAPAIAN LAYANAN</div>
                    <div class="stat-value fs-3 fw-bold text-secondary mt-1">
                        <?php echo e(number_format($serviceTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted">KIA <?php echo e($kiaTotal); ?> · Pangan <?php echo e($foodTotal); ?></small>
                </div>
            </div>

            <!-- MBG -->
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card card-stat p-3 text-center">
                    <div class="stat-icon bg-danger-subtle text-danger mx-auto">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div class="text-muted small fw-bold">PORSI MBG</div>
                    <div class="stat-value fs-3 fw-bold text-danger mt-1">
                        <?php echo e(number_format($mbgPortionTotal, 0, ',', '.')); ?>

                    </div>
                    <small class="text-muted">distribusi harian</small>
                </div>
            </div>
        </div>
    </section>

    <!-- RINGKASAN TAMBAHAN -->
    <section class="row g-3 mb-4">
        <div class="col-12 col-md-3">
            <div class="card card-stat p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold">REMAJA PUTRI</div>
                        <div class="fs-4 fw-bold"><?php echo e(number_format($youngFemaleTotal, 0, ',', '.')); ?></div>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger">
                        <i class="fa-solid fa-person-dress"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold">BALITA SASARAN</div>
                        <div class="fs-4 fw-bold"><?php echo e(number_format($childrenTotal, 0, ',', '.')); ?></div>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="fa-solid fa-child"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold">GURU PAUD</div>
                        <div class="fs-4 fw-bold"><?php echo e(number_format($guruPaudTotal, 0, ',', '.')); ?></div>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="fa-solid fa-person-chalkboard"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small fw-bold">DATA INDIVIDU BALITA</div>
                        <div class="fs-4 fw-bold"><?php echo e(number_format($individualTotal, 0, ',', '.')); ?></div>
                    </div>
                    <div class="stat-icon bg-dark-subtle text-dark">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TOMBOL UMUM -->
    <section class="d-flex flex-wrap justify-content-end gap-2 mb-4 no-print">
        <button type="button" class="btn btn-outline-secondary" onclick="resetAllFilters()">
            <i class="fa-solid fa-filter-circle-xmark me-1"></i> Reset Filter
        </button>
        <button type="button" class="btn btn-outline-success" onclick="exportAllTables()">
            <i class="fa-solid fa-file-csv me-1"></i> Export CSV
        </button>
        <button type="button" class="btn btn-primary" onclick="printDashboard()">
            <i class="fa-solid fa-file-pdf me-1"></i> Cetak / Simpan PDF
        </button>
    </section>

    <!-- NAVIGASI -->
    <section class="card content-card p-3 mb-4 no-print">
        <ul class="nav nav-pills gap-2" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="tab-sasaran" data-bs-toggle="pill" data-bs-target="#content-sasaran" type="button">
                    <i class="fa-solid fa-users me-1"></i> 1. Data Sasaran
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-pendukung" data-bs-toggle="pill" data-bs-target="#content-pendukung" type="button">
                    <i class="fa-solid fa-school me-1"></i> 2. Data Pendukung
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-kendala" data-bs-toggle="pill" data-bs-target="#content-kendala" type="button">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> 3. Identifikasi Kendala
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-anggaran" data-bs-toggle="pill" data-bs-target="#content-anggaran" type="button">
                    <i class="fa-solid fa-wallet me-1"></i> 4. Penyediaan Anggaran
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-layanan" data-bs-toggle="pill" data-bs-target="#content-layanan" type="button">
                    <i class="fa-solid fa-chart-line me-1"></i> 5. Capaian Layanan
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-mbg" data-bs-toggle="pill" data-bs-target="#content-mbg" type="button">
                    <i class="fa-solid fa-utensils me-1"></i> 6. Makan Bergizi Gratis
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-individu" data-bs-toggle="pill" data-bs-target="#content-individu" type="button">
                    <i class="fa-solid fa-child me-1"></i> 7. Data Individu Balita
                </button>
            </li>
        </ul>
    </section>

    <div class="tab-content" id="pills-tabContent">

        <!-- ========================================================= -->
        <!-- 1. DATA SASARAN -->
        <!-- ========================================================= -->
        <div class="tab-pane fade show active" id="content-sasaran" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Data Sasaran Desa / Kelurahan</h5>
                        <div class="section-subtitle">Penduduk, keluarga, remaja putri, dan balita.</div>
                    </div>
                    <span class="badge bg-primary-subtle text-primary badge-soft">
                        <?php echo e($targetData instanceof \Illuminate\Contracts\Pagination\Paginator || $targetData instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $targetData->total() : $targetRows->count()); ?>

                        data
                    </span>
                </div>

                <form action="<?php echo e(route('target.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-lg-3">
                        <label class="form-label small fw-bold">Nama Desa / Kelurahan</label>
                        <input type="text" name="village_name" class="form-control"
                               placeholder="Contoh: Singaparna" value="<?php echo e(old('village_name')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Jml Penduduk</label>
                        <input type="number" min="0" name="population_count" class="form-control"
                               value="<?php echo e(old('population_count', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Jml KK</label>
                        <input type="number" min="0" name="family_count" class="form-control"
                               value="<?php echo e(old('family_count', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Remaja Putri</label>
                        <input type="number" min="0" name="young_female_count" class="form-control"
                               value="<?php echo e(old('young_female_count', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-3">
                        <label class="form-label small fw-bold">Balita</label>
                        <input type="number" min="0" name="children_count" class="form-control"
                               value="<?php echo e(old('children_count', 0)); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Data Sasaran
                        </button>
                    </div>
                </form>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-sasaran" placeholder="Cari desa / kelurahan...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 text-md-end">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-sasaran', 'data-sasaran.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-sasaran">
                        <thead class="table-light">
                            <tr>
                                <th>Desa / Kelurahan</th>
                                <th class="text-end">Penduduk</th>
                                <th class="text-end">KK</th>
                                <th class="text-end">Remaja Putri</th>
                                <th class="text-end">Balita</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $targetRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($target->village_name ?? '-'); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($target->population_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($target->family_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($target->young_female_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($target->children_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('target.destroy', $target->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr class="empty-row">
                                    <td colspan="6" class="empty-state">
                                        <i class="fa-regular fa-folder-open fa-2x mb-2"></i><br>
                                        Belum ada data sasaran.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL</td>
                                <td class="text-end"><?php echo e(number_format($populationTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($familyTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($youngFemaleTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($childrenTotal, 0, ',', '.')); ?></td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php if(is_object($targetData) && method_exists($targetData, 'links')): ?>
                    <?php echo e($targetData->appends(['mbg_page' => is_object($mbgData) && method_exists($mbgData, 'currentPage') ? $mbgData->currentPage() : 1])->links()); ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 2. DATA PENDUKUNG -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-pendukung" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Data Pendukung Sarana & Prasarana</h5>
                        <div class="section-subtitle">PAUD, SMP sederajat, SMA sederajat, dan Guru PAUD.</div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-success-subtle text-success badge-soft">PAUD: <?php echo e($paudTotal); ?></span>
                        <span class="badge bg-primary-subtle text-primary badge-soft">SMP: <?php echo e($smpTotal); ?></span>
                        <span class="badge bg-warning-subtle text-warning badge-soft">SMA: <?php echo e($smaTotal); ?></span>
                    </div>
                </div>

                <!-- FIX: sebelumnya ada 3 <form> bersarang (nested) untuk endpoint yang sama.
                     Nested <form> tidak valid dalam HTML dan bisa membuat <?php echo csrf_field(); ?>/token gagal
                     terkirim dengan benar. Sekarang hanya SATU form dengan SATU <?php echo csrf_field(); ?>. -->
                <form action="<?php echo e(route('support.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-lg-3">
                        <label class="form-label small fw-bold">Nama Desa / Kelurahan</label>
                        <input type="text" name="village_name" class="form-control"
                               placeholder="Contoh: Singaparna" value="<?php echo e(old('village_name')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Jml PAUD</label>
                        <input type="number" min="0" name="jml_paud" class="form-control"
                               value="<?php echo e(old('jml_paud')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">SMP Sederajat</label>
                        <input type="number" min="0" name="smp_mts" class="form-control"
                               value="<?php echo e(old('smp_mts')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">SMA Sederajat</label>
                        <input type="number" min="0" name="sma_ma" class="form-control"
                               value="<?php echo e(old('sma_ma')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-3">
                        <label class="form-label small fw-bold">Guru PAUD</label>
                        <input type="number" min="0" name="guru_paud" class="form-control"
                               value="<?php echo e(old('guru_paud')); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Data Pendukung
                        </button>
                    </div>
                </form>

                <div class="row g-3 mb-3">
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">PAUD</div>
                            <div class="fs-4 fw-bold text-success"><?php echo e(number_format($paudTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">SMP Sederajat</div>
                            <div class="fs-4 fw-bold text-primary"><?php echo e(number_format($smpTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">SMA Sederajat</div>
                            <div class="fs-4 fw-bold text-warning"><?php echo e(number_format($smaTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Guru PAUD</div>
                            <div class="fs-4 fw-bold text-info"><?php echo e(number_format($guruPaudTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                </div>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-pendukung" placeholder="Cari desa / kelurahan...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-pendukung', 'data-pendukung.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-pendukung">
                        <thead class="table-light">
                            <tr>
                                <th>Desa / Kelurahan</th>
                                <th class="text-end">Jml PAUD</th>
                                <th class="text-end">SMP Sederajat</th>
                                <th class="text-end">SMA Sederajat</th>
                                <th class="text-end">Guru PAUD</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $supportRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($support->village_name ?? '-'); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($support->jml_paud ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($support->smp_mts ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($support->sma_ma ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($support->guru_paud ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('support.destroy', $support->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fa-solid fa-school fa-2x mb-2"></i><br>
                                        Belum ada data pendukung.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL</td>
                                <td class="text-end"><?php echo e(number_format($paudTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($smpTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($smaTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($guruPaudTotal, 0, ',', '.')); ?></td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 3. IDENTIFIKASI KENDALA -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-kendala" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Identifikasi Kendala</h5>
                        <div class="section-subtitle">Catat kendala atau hambatan di lapangan.</div>
                    </div>
                    <span class="badge bg-warning-subtle text-warning badge-soft">
                        <?php echo e(number_format($constraintTotal, 0, ',', '.')); ?> kendala
                    </span>
                </div>

                <form action="<?php echo e(route('constraint.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold">Desa / Kelurahan</label>
                        <input type="text" name="village_name" class="form-control"
                               value="<?php echo e(old('village_name')); ?>" required>
                    </div>

                    <div class="col-12 col-md-8">
                        <label class="form-label small fw-bold">Deskripsi Kendala</label>
                        <input type="text" name="description" class="form-control"
                               value="<?php echo e(old('description')); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Simpan Kendala
                        </button>
                    </div>
                </form>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-kendala" placeholder="Cari desa atau kendala...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-kendala', 'identifikasi-kendala.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-kendala">
                        <thead class="table-light">
                            <tr>
                                <th>Desa / Kelurahan</th>
                                <th>Kendala</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $constraintRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($item->village_name ?? '-'); ?></td>
                                    <td><?php echo e($item->description ?? '-'); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('constraint.destroy', $item->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="empty-state">
                                        <i class="fa-solid fa-circle-check fa-2x mb-2"></i><br>
                                        Belum ada kendala.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL KENDALA</td>
                                <td><?php echo e(number_format($constraintTotal, 0, ',', '.')); ?> data</td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 4. PENYEDIAAN ANGGARAN -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-anggaran" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Penyediaan Anggaran</h5>
                        <div class="section-subtitle">Alokasi anggaran untuk kegiatan pencegahan stunting.</div>
                    </div>
                    <span class="badge bg-info-subtle text-info badge-soft">
                        Rp <?php echo e(number_format($budgetTotal, 0, ',', '.')); ?>

                    </span>
                </div>

                <form action="<?php echo e(route('budget.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Desa / Kelurahan</label>
                        <input type="text" name="village_name" class="form-control"
                               value="<?php echo e(old('village_name')); ?>" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Nama Indikator</label>
                        <input type="text" name="indicator_name" class="form-control"
                               value="<?php echo e(old('indicator_name')); ?>" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Jumlah Anggaran (Rp)</label>
                        <input type="number" min="0" step="1" name="amount" class="form-control"
                               value="<?php echo e(old('amount', 0)); ?>" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Deskripsi Kegiatan</label>
                        <input type="text" name="activity_description" class="form-control"
                               value="<?php echo e(old('activity_description')); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Anggaran
                        </button>
                    </div>
                </form>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-anggaran" placeholder="Cari desa, indikator, kegiatan...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-anggaran', 'penyediaan-anggaran.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-anggaran">
                        <thead class="table-light">
                            <tr>
                                <th>Desa / Kelurahan</th>
                                <th>Indikator</th>
                                <th class="text-end">Jumlah (Rp)</th>
                                <th>Deskripsi Kegiatan</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $budgetRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($budget->village_name ?? '-'); ?></td>
                                    <td><?php echo e($budget->indicator_name ?? '-'); ?></td>
                                    <td class="text-end number-cell">
                                        Rp <?php echo e(number_format((float)($budget->amount ?? 0), 0, ',', '.')); ?>

                                    </td>
                                    <td><?php echo e($budget->activity_description ?? '-'); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('budget.destroy', $budget->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fa-solid fa-wallet fa-2x mb-2"></i><br>
                                        Belum ada data anggaran.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="2">TOTAL ANGGARAN</td>
                                <td class="text-end">Rp <?php echo e(number_format($budgetTotal, 0, ',', '.')); ?></td>
                                <td></td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 5. CAPAIAN LAYANAN -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-layanan" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Capaian Layanan</h5>
                        <div class="section-subtitle">Capaian program KIA dan pemanfaatan pangan.</div>
                    </div>
                    <span class="badge bg-secondary-subtle text-secondary badge-soft">
                        Total: <?php echo e(number_format($serviceTotal, 0, ',', '.')); ?>

                    </span>
                </div>

                <form action="<?php echo e(route('service.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold">Desa / Kelurahan</label>
                        <input type="text" name="village_name" class="form-control"
                               value="<?php echo e(old('village_name')); ?>" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold">Capaian KIA / Akta Lahir</label>
                        <input type="number" min="0" name="birth_kia_count" class="form-control"
                               value="<?php echo e(old('birth_kia_count', 0)); ?>" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold">Program Pangan / Pekarangan</label>
                        <input type="number" min="0" name="food_program_count" class="form-control"
                               value="<?php echo e(old('food_program_count', 0)); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Simpan Capaian
                        </button>
                    </div>
                </form>

                <div class="row g-3 mb-3">
                    <div class="col-6 col-md-4">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Capaian KIA</div>
                            <div class="fs-4 fw-bold text-primary"><?php echo e(number_format($kiaTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Program Pangan</div>
                            <div class="fs-4 fw-bold text-success"><?php echo e(number_format($foodTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Total Capaian</div>
                            <div class="fs-4 fw-bold text-secondary"><?php echo e(number_format($serviceTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                </div>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-layanan" placeholder="Cari desa / kelurahan...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-layanan', 'capaian-layanan.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-layanan">
                        <thead class="table-light">
                            <tr>
                                <th>Desa / Kelurahan</th>
                                <th class="text-end">Capaian KIA</th>
                                <th class="text-end">Program Pangan</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $serviceRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($service->village_name ?? '-'); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($service->birth_kia_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($service->food_program_count ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('service.destroy', $service->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        <i class="fa-solid fa-chart-line fa-2x mb-2"></i><br>
                                        Belum ada data capaian layanan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL</td>
                                <td class="text-end"><?php echo e(number_format($kiaTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($foodTotal, 0, ',', '.')); ?></td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 6. MBG -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-mbg" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Makan Bergizi Gratis (MBG)</h5>
                        <div class="section-subtitle">Penerima manfaat dan distribusi porsi.</div>
                    </div>
                    <span class="badge bg-danger-subtle text-danger badge-soft">
                        Porsi: <?php echo e(number_format($mbgPortionTotal, 0, ',', '.')); ?>

                    </span>
                </div>

                <form action="<?php echo e(route('mbg.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-lg-3">
                        <label class="form-label small fw-bold">Nama Desa</label>
                        <input type="text" name="nama_desa" class="form-control"
                               value="<?php echo e(old('nama_desa')); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Penerima Balita</label>
                        <input type="number" min="0" name="penerima_balita" class="form-control"
                               value="<?php echo e(old('penerima_balita', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Penerima Bumil</label>
                        <input type="number" min="0" name="penerima_bumil" class="form-control"
                               value="<?php echo e(old('penerima_bumil', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-bold">Penerima PAUD</label>
                        <input type="number" min="0" name="penerima_paud" class="form-control"
                               value="<?php echo e(old('penerima_paud', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-lg-3">
                        <label class="form-label small fw-bold">Porsi Harian</label>
                        <input type="number" min="0" name="porsi_terdistribusi_harian" class="form-control"
                               value="<?php echo e(old('porsi_terdistribusi_harian', 0)); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Simpan Data MBG
                        </button>
                    </div>
                </form>

                <div class="row g-3 mb-3">
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Balita</div>
                            <div class="fs-4 fw-bold text-primary"><?php echo e(number_format($mbgBalitaTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Bumil</div>
                            <div class="fs-4 fw-bold text-danger"><?php echo e(number_format($mbgBumilTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">PAUD</div>
                            <div class="fs-4 fw-bold text-success"><?php echo e(number_format($mbgPaudTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="small text-muted">Porsi Harian</div>
                            <div class="fs-4 fw-bold text-warning"><?php echo e(number_format($mbgPortionTotal, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                </div>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-mbg" placeholder="Cari desa...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-mbg', 'data-mbg.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-mbg">
                        <thead class="table-light">
                            <tr>
                                <th>Desa</th>
                                <th class="text-end">Balita</th>
                                <th class="text-end">Bumil</th>
                                <th class="text-end">PAUD</th>
                                <th class="text-end">Porsi Harian</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $mbgRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mbg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($mbg->nama_desa ?? '-'); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($mbg->penerima_balita ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($mbg->penerima_bumil ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($mbg->penerima_paud ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end number-cell"><?php echo e(number_format((int)($mbg->porsi_terdistribusi_harian ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('mbg.destroy', $mbg->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fa-solid fa-utensils fa-2x mb-2"></i><br>
                                        Belum ada data MBG.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL</td>
                                <td class="text-end"><?php echo e(number_format($mbgBalitaTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($mbgBumilTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($mbgPaudTotal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e(number_format($mbgPortionTotal, 0, ',', '.')); ?></td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php if(is_object($mbgData) && method_exists($mbgData, 'links')): ?>
                    <?php echo e($mbgData->appends(['target_page' => is_object($targetData) && method_exists($targetData, 'currentPage') ? $targetData->currentPage() : 1])->links()); ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 7. DATA INDIVIDU BALITA -->
        <!-- ========================================================= -->
        <div class="tab-pane fade" id="content-individu" role="tabpanel">
            <div class="card content-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <div>
                        <h5 class="section-title">Data Individu Balita</h5>
                        <div class="section-subtitle">Pencatatan spesifik tumbuh kembang balita.</div>
                    </div>
                    <span class="badge bg-dark-subtle text-dark badge-soft">
                        <?php echo e(number_format($individualTotal, 0, ',', '.')); ?> data
                    </span>
                </div>

                <form action="<?php echo e(route('individual.store')); ?>" method="POST" class="row g-3 mb-4 no-print">
                    <?php echo csrf_field(); ?>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Nama Desa</label>
                        <input type="text" name="nama_desa" class="form-control"
                               value="<?php echo e(old('nama_desa')); ?>" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-bold">Nama Anak</label>
                        <input type="text" name="nama_anak" class="form-control"
                               value="<?php echo e(old('nama_anak')); ?>" required>
                    </div>

                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-bold">Umur (Bulan)</label>
                        <input type="number" min="0" name="umur_bulan" class="form-control"
                               value="<?php echo e(old('umur_bulan', 0)); ?>" required>
                    </div>

                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-bold">Tinggi Badan (cm)</label>
                        <input type="number" min="0" step="0.1" name="tinggi_badan" class="form-control"
                               value="<?php echo e(old('tinggi_badan', 0)); ?>" required>
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label small fw-bold">Berat Badan (kg)</label>
                        <input type="number" min="0" step="0.1" name="berat_badan" class="form-control"
                               value="<?php echo e(old('berat_badan', 0)); ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                               value="<?php echo e(old('alamat')); ?>" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Simpan Data Balita
                        </button>
                    </div>
                </form>

                <div class="toolbar mb-3 no-print">
                    <div class="row g-2">
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="search" class="form-control table-search"
                                       data-table="table-individu" placeholder="Cari desa, nama anak, atau alamat...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100" onclick="exportTable('table-individu', 'data-individu-balita.csv')">
                                <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle exportable-table" id="table-individu">
                        <thead class="table-light">
                            <tr>
                                <th>Desa</th>
                                <th>Nama Anak</th>
                                <th class="text-end">Umur (Bulan)</th>
                                <th class="text-end">Tinggi (cm)</th>
                                <th class="text-end">Berat (kg)</th>
                                <th>Alamat</th>
                                <th class="text-end action-cell no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $individualRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($ind->nama_desa ?? '-'); ?></td>
                                    <td><?php echo e($ind->nama_anak ?? '-'); ?></td>
                                    <td class="text-end"><?php echo e(number_format((int)($ind->umur_bulan ?? 0), 0, ',', '.')); ?></td>
                                    <td class="text-end"><?php echo e(number_format((float)($ind->tinggi_badan ?? 0), 1, ',', '.')); ?></td>
                                    <td class="text-end"><?php echo e(number_format((float)($ind->berat_badan ?? 0), 1, ',', '.')); ?></td>
                                    <td><?php echo e($ind->alamat ?? '-'); ?></td>
                                    <td class="text-end no-print">
                                        <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                        <form action="<?php echo e(route('individual.destroy', $ind->id)); ?>" method="POST" class="d-inline delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fa-solid fa-child fa-2x mb-2"></i><br>
                                        Belum ada data individu balita.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(is_object($individualData) && method_exists($individualData, 'links')): ?>
                    <?php echo e($individualData->links()); ?>

                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- CATATAN -->
    <div class="alert alert-info mt-4 no-print">
        <i class="fa-solid fa-circle-info me-2"></i>
        <strong>Catatan:</strong>
        Total pada dashboard akan menggunakan nilai agregat yang dikirim Controller jika tersedia.
        Jika Controller belum mengirim nilai agregat, Blade menghitung berdasarkan data yang tersedia pada halaman ini.
    </div>

</main>

<button type="button" class="btn btn-primary back-to-top" id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /*
     * ==========================================================
     * UTILITAS DASHBOARD
     * ==========================================================
     */

    // Waktu dashboard.
    function updateDateTime() {
        const el = document.getElementById('currentDateTime');
        if (!el) return;

        const now = new Date();

        const date = now.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });

        const time = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        el.textContent = date + ' ' + time;
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);


    // Konfirmasi semua tombol hapus.
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            const confirmed = confirm(
                'Apakah Anda yakin ingin menghapus data ini?\n\nData yang sudah dihapus tidak dapat dikembalikan.'
            );

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });


    // Pencarian tabel.
    document.querySelectorAll('.table-search').forEach(function(input) {
        input.addEventListener('input', function() {
            const tableId = input.dataset.table;
            const table = document.getElementById(tableId);

            if (!table) return;

            const keyword = input.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                if (row.classList.contains('empty-row')) return;

                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    });


    // Reset semua pencarian.
    function resetAllFilters() {
        document.querySelectorAll('.table-search').forEach(function(input) {
            input.value = '';
            input.dispatchEvent(new Event('input'));
        });
    }


    // Cetak dashboard.
    function printDashboard() {
        window.print();
    }


    // CSV escape.
    function csvEscape(value) {
        let text = String(value ?? '');

        text = text
            .replace(/\u00a0/g, ' ')
            .replace(/\r?\n|\r/g, ' ')
            .trim();

        if (text.includes('"') || text.includes(',') || text.includes(';')) {
            return '"' + text.replace(/"/g, '""') + '"';
        }

        return text;
    }


    // Export satu tabel ke CSV.
    function exportTable(tableId, filename) {
        const table = document.getElementById(tableId);

        if (!table) {
            alert('Tabel tidak ditemukan.');
            return;
        }

        const rows = [];

        table.querySelectorAll('tr').forEach(function(row) {
            if (row.style.display === 'none') return;

            const cells = [];

            row.querySelectorAll('th, td').forEach(function(cell) {
                // Kolom aksi tidak ikut CSV.
                if (cell.classList.contains('action-cell') || cell.classList.contains('no-print')) {
                    return;
                }

                cells.push(csvEscape(cell.innerText));
            });

            if (cells.length > 0) {
                rows.push(cells.join(','));
            }
        });

        if (rows.length === 0) {
            alert('Tidak ada data untuk diekspor.');
            return;
        }

        const csv = '\uFEFF' + rows.join('\r\n');
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);

        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        URL.revokeObjectURL(url);
    }


    // Export seluruh tabel menjadi beberapa file CSV.
    function exportAllTables() {
        const tables = [
            ['table-sasaran', 'data-sasaran.csv'],
            ['table-pendukung', 'data-pendukung.csv'],
            ['table-kendala', 'identifikasi-kendala.csv'],
            ['table-anggaran', 'penyediaan-anggaran.csv'],
            ['table-layanan', 'capaian-layanan.csv'],
            ['table-mbg', 'data-mbg.csv'],
            ['table-individu', 'data-individu-balita.csv']
        ];

        let delay = 0;

        tables.forEach(function(item) {
            setTimeout(function() {
                exportTable(item[0], item[1]);
            }, delay);

            delay += 500;
        });
    }


    // Tombol kembali ke atas.
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', function() {
        if (!backToTop) return;

        backToTop.style.display = window.scrollY > 400 ? 'inline-flex' : 'none';
        backToTop.style.alignItems = 'center';
        backToTop.style.justifyContent = 'center';
    });


    // Pertahankan tab aktif setelah reload menggunakan sessionStorage.
    document.querySelectorAll('#pills-tab button[data-bs-toggle="pill"]').forEach(function(tab) {
        tab.addEventListener('shown.bs.tab', function(event) {
            sessionStorage.setItem('stunting_active_tab', event.target.id);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const savedTab = sessionStorage.getItem('stunting_active_tab');

        if (!savedTab) return;

        const tab = document.getElementById(savedTab);

        if (tab) {
            const tabInstance = bootstrap.Tab.getOrCreateInstance(tab);
            tabInstance.show();
        }
    });
</script>

</body>
</html><?php /**PATH D:\laravel\stunting-singaparna\resources\views/dashboard.blade.php ENDPATH**/ ?>