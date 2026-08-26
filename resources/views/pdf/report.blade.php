<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">

    <title>Laporan Stunting Singaparna</title>

    <style>
        @page {
            margin: 25px 30px 35px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1d4ed8;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #1e3a8a;
        }

        .header h2 {
            margin: 3px 0;
            font-size: 13px;
            color: #334155;
        }

        .header p {
            margin: 2px 0;
            font-size: 9px;
            color: #64748b;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .summary td {
            width: 25%;
            border: 1px solid #dbeafe;
            background-color: #eff6ff;
            padding: 8px;
            text-align: center;
        }

        .summary .number {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .summary .label {
            display: block;
            font-size: 8px;
            color: #64748b;
            margin-top: 2px;
        }

        h3 {
            margin-top: 18px;
            margin-bottom: 6px;
            padding: 6px 8px;
            background-color: #eff6ff;
            color: #1e3a8a;
            border-left: 4px solid #2563eb;
            font-size: 11px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #d1d5db;
            padding: 5px 6px;
            vertical-align: top;
        }

        .data-table th {
            background-color: #e5e7eb;
            color: #1f2937;
            font-weight: bold;
            text-align: center;
        }

        .data-table td {
            background-color: #fff;
        }

        .data-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .empty {
            text-align: center;
            color: #9ca3af;
            padding: 10px;
            font-style: italic;
        }

        .status {
            text-align: center;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 5px;
        }

        .page-number:after {
            content: counter(page);
        }

        .signature {
            width: 100%;
            margin-top: 30px;
        }

        .signature td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }

        .signature-space {
            height: 55px;
        }

        .note {
            font-size: 8px;
            color: #64748b;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <!-- ==========================================
         HEADER
    =========================================== -->

    <div class="header">

        <h1>
            SISTEM INFORMASI MONITORING STUNTING
        </h1>

        <h2>
            KECAMATAN SINGAPARNA
        </h2>

        <p>
            Laporan Data Monitoring dan Pencegahan Stunting
        </p>

        <p>
            Dicetak:
            {{ now()->format('d/m/Y H:i') }} WIB
        </p>

    </div>


    <!-- ==========================================
         RINGKASAN
    =========================================== -->

    <table class="summary">

        <tr>

            <td>
                <span class="number">
                    {{ $targetData->count() }}
                </span>

                <span class="label">
                    Desa Terdata
                </span>
            </td>

            <td>
                <span class="number">
                    {{ $individualData->count() ?? 0 }}
                </span>

                <span class="label">
                    Data Individu
                </span>
            </td>

            <td>
                <span class="number">
                    {{ $mbgData->count() ?? 0 }}
                </span>

                <span class="label">
                    Data MBG
                </span>
            </td>

            <td>
                <span class="number">
                    Rp {{ number_format($budgets->sum('amount'), 0, ',', '.') }}
                </span>

                <span class="label">
                    Total Anggaran
                </span>
            </td>

        </tr>

    </table>


    <!-- ==========================================
         1. DATA SASARAN
    =========================================== -->

    <h3>1. Data Sasaran</h3>

    <table class="data-table">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Desa</th>
                <th>Jumlah Penduduk</th>
                <th>Jumlah KK</th>
                <th>Remaja Putri</th>
                <th>Anak-anak</th>
            </tr>
        </thead>

        <tbody>

            @forelse($targetData as $index => $item)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->village_name }}
                    </td>

                    <td class="right">
                        {{ number_format($item->population_count, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($item->family_count, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($item->young_female_count, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($item->children_count, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="empty">
                        Belum ada data sasaran.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ==========================================
         2. DATA PENDUKUNG
    =========================================== -->

    <h3>2. Data Pendukung</h3>

    <table class="data-table">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Desa</th>
                <th>PAUD</th>
                <th>SMP/MTs</th>
                <th>SMA/MA</th>
                <th>Guru PAUD</th>
            </tr>
        </thead>

        <tbody>

            @forelse($supportData as $index => $item)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->village_name }}
                    </td>

                    <td class="center">
                        {{ number_format($item->paud_institution_count, 0, ',', '.') }}
                    </td>

                    <td class="center">
                        {{ number_format($item->smp_mts_count, 0, ',', '.') }}
                    </td>

                    <td class="center">
                        {{ number_format($item->sma_ma_count, 0, ',', '.') }}
                    </td>

                    <td class="center">
                        {{ number_format($item->paud_teacher_count, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="empty">
                        Belum ada data pendukung.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ==========================================
         3. IDENTIFIKASI KENDALA
    =========================================== -->

    <h3>3. Identifikasi Kendala</h3>

    <table class="data-table">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Lingkup</th>
                <th>Masalah</th>
                <th>Rekomendasi</th>
                <th>Biaya Dibutuhkan</th>
            </tr>
        </thead>

        <tbody>

            @forelse($constraints as $index => $item)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->scope }}
                    </td>

                    <td>
                        {{ $item->problem }}
                    </td>

                    <td>
                        {{ $item->recommendation }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($item->budget_needed, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="empty">
                        Belum ada data kendala.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ==========================================
         4. PENYEDIAAN ANGGARAN
    =========================================== -->

    <h3>4. Penyediaan Anggaran</h3>

    <table class="data-table">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Indikator</th>
                <th>Deskripsi Kegiatan</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>

            @forelse($budgets as $index => $item)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->indicator_name }}
                    </td>

                    <td>
                        {{ $item->activity_description }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($item->amount, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="empty">
                        Belum ada data anggaran.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ==========================================
         5. CAPAIAN LAYANAN
    =========================================== -->

    @isset($serviceData)

        <h3>5. Capaian Layanan</h3>

        <table class="data-table">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Desa</th>
                    <th>Capaian KIA</th>
                    <th>Capaian Program Pangan</th>
                </tr>
            </thead>

            <tbody>

                @forelse($serviceData as $index => $item)

                    <tr>

                        <td class="center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->village_name }}
                        </td>

                        <td class="center">
                            {{ number_format($item->birth_kia_count, 0, ',', '.') }}
                            jiwa
                        </td>

                        <td class="center">
                            {{ number_format($item->food_program_count, 0, ',', '.') }}
                            keluarga
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada data capaian layanan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    @endisset


    <!-- ==========================================
         6. PROGRAM MBG
    =========================================== -->

    @isset($mbgData)

        <h3>6. Program Makan Bergizi Gratis (MBG)</h3>

        <table class="data-table">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Desa</th>
                    <th>Balita</th>
                    <th>Bumil</th>
                    <th>PAUD</th>
                    <th>Porsi/Hari</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($mbgData as $index => $item)

                    <tr>

                        <td class="center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->nama_desa }}
                        </td>

                        <td class="center">
                            {{ number_format($item->penerima_balita, 0, ',', '.') }}
                        </td>

                        <td class="center">
                            {{ number_format($item->penerima_bumil, 0, ',', '.') }}
                        </td>

                        <td class="center">
                            {{ number_format($item->penerima_paud, 0, ',', '.') }}
                        </td>

                        <td class="center">
                            {{ number_format($item->porsi_terdistribusi_harian, 0, ',', '.') }}
                        </td>

                        <td class="status">
                            {{ $item->status_layanan }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data MBG.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    @endisset


    <!-- ==========================================
         7. DATA INDIVIDU
    =========================================== -->

    @isset($individualData)

        <h3>7. Data Individu Balita</h3>

        <table class="data-table">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Anak</th>
                    <th>Desa</th>
                    <th>Umur</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Alamat</th>
                </tr>
            </thead>

            <tbody>

                @forelse($individualData as $index => $item)

                    <tr>

                        <td class="center">
                            {{ $index + 1 }}
                        </td>

                        {{-- Sesuai migration individual_data --}}
                        <td>
                            {{ $item->nama_anak }}
                        </td>

                        <td>
                            {{ $item->nama_desa }}
                        </td>

                        <td class="center">
                            {{ $item->umur_bulan }} bulan
                        </td>

                        <td class="center">
                            {{ number_format($item->tinggi_badan, 1, ',', '.') }}
                            cm
                        </td>

                        <td class="center">
                            {{ number_format($item->berat_badan, 1, ',', '.') }}
                            kg
                        </td>

                        <td>
                            {{ $item->alamat ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data individu balita.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    @endisset


    <!-- ==========================================
         CATATAN
    =========================================== -->

    <p class="note">
        Catatan: Laporan ini dibuat berdasarkan data yang tersimpan
        pada Sistem Informasi Monitoring Stunting Kecamatan Singaparna.
    </p>


    <!-- ==========================================
         TANDA TANGAN
    =========================================== -->

    <table class="signature">

        <tr>

            <td>
                Mengetahui,<br>
                Petugas Kecamatan
                <div class="signature-space"></div>

                <strong>
                    ( ........................................ )
                </strong>
            </td>

            <td>
                Singaparna,
                {{ now()->translatedFormat('d F Y') }}<br>
                Operator Sistem
                <div class="signature-space"></div>

                <strong>
                    ( ........................................ )
                </strong>
            </td>

        </tr>

    </table>


    <!-- ==========================================
         FOOTER
    =========================================== -->

    <div class="footer">

        Sistem Informasi Monitoring Stunting Singaparna
        &nbsp; | &nbsp;
        Halaman <span class="page-number"></span>

    </div>

</body>
</html>