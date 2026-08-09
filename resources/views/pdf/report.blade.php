<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stunting Singaparna</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Laporan Stunting Wilayah Singaparna</h2>

    <h3>1. Data Sasaran</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Desa</th>
                <th>Jumlah Penduduk</th>
                <th>Jumlah KK</th>
                <th>Remaja Putri</th>
                <th>Anak-anak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($targetData as $item)
            <tr>
                <td>{{ $item->village_name }}</td>
                <td>{{ $item->population_count }}</td>
                <td>{{ $item->family_count }}</td>
                <td>{{ $item->young_female_count }}</td>
                <td>{{ $item->children_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>2. Data Pendukung</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Desa</th>
                <th>PAUD</th>
                <th>SMP/MTS</th>
                <th>SMA/MA</th>
                <th>Guru PAUD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supportData as $item)
            <tr>
                <td>{{ $item->village_name }}</td>
                <td>{{ $item->paud_institution_count }}</td>
                <td>{{ $item->smp_mts_count }}</td>
                <td>{{ $item->sma_ma_count }}</td>
                <td>{{ $item->paud_teacher_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>3. Identifikasi Kendala</h3>
    <table>
        <thead>
            <tr>
                <th>Lingkup</th>
                <th>Masalah</th>
                <th>Rekomendasi</th>
                <th>Biaya Dibutuhkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($constraints as $item)
            <tr>
                <td>{{ $item->scope }}</td>
                <td>{{ $item->problem }}</td>
                <td>{{ $item->recommendation }}</td>
                <td>Rp {{ number_format($item->budget_needed, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>4. Penyediaan Anggaran</h3>
    <table>
        <thead>
            <tr>
                <th>ID Indikator</th>
                <th>Nama Indikator</th>
                <th>Deskripsi Kegiatan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budgets as $item)
            <tr>
                <td>{{ $item->indicator_id }}</td>
                <td>{{ $item->indicator_name }}</td>
                <td>{{ $item->activity_description }}</td>
                <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>