<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stunting Singaparna</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen" x-data="{ activeTab: 'target' }">

    <!-- Navbar / Header -->
    <header class="bg-indigo-700 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <i class="fa-solid font-bold text-2xl fa-hand-holding-heart text-amber-400"></i>
                <div>
                    <h1 class="text-xl font-bold tracking-wide">Stunting Singaparna</h1>
                    <p class="text-xs text-indigo-200">Sistem Informasi Monitoring & Identifikasi Stunting</p>
                </div>
            </div>

            <!-- Export Buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('export.pdf') }}" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium shadow transition">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span>Export PDF</span>
                </a>
                <a href="{{ route('export.excel') }}" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg text-sm font-medium shadow transition">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>Export Excel</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Messages / Alerts -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-100 border-l-4 border-rose-500 text-rose-800 rounded-r-lg shadow">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
                    <span>Terjadi kesalahan input:</span>
                </div>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Summary Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg"><i class="fa-solid fa-users text-xl"></i></div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Data Sasaran</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $targetData->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="p-3 bg-teal-100 text-teal-600 rounded-lg"><i class="fa-solid fa-building-columns text-xl"></i></div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Pendukung</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $supportData->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg"><i class="fa-solid fa-triangle-exclamation text-xl"></i></div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Kendala</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $constraints->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg"><i class="fa-solid fa-wallet text-xl"></i></div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Anggaran</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $budgets->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="p-3 bg-purple-100 text-purple-600 rounded-lg"><i class="fa-solid fa-chart-line text-xl"></i></div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Capaian Layanan</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $serviceData->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap gap-2 border-b border-slate-200 mb-6 bg-white p-2 rounded-xl shadow-sm">
            <button @click="activeTab = 'target'" :class="activeTab === 'target' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-bullseye"></i> 1. Data Sasaran
            </button>
            <button @click="activeTab = 'support'" :class="activeTab === 'support' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-hand-holding-hand"></i> 2. Data Pendukung
            </button>
            <button @click="activeTab = 'constraint'" :class="activeTab === 'constraint' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i> 3. Identifikasi Kendala
            </button>
            <button @click="activeTab = 'budget'" :class="activeTab === 'budget' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-money-bill-wave"></i> 4. Penyediaan Anggaran
            </button>
            <button @click="activeTab = 'service'" :class="activeTab === 'service' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-notes-medical"></i> 5. Capaian Layanan
            </button>
            <button @click="activeTab = 'mbg'" :class="activeTab === 'mbg' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fa-solid fa-bowl-food"></i> 6. Makan Bergizi Gratis
            </button>
        </div>

        <!-- TAB 1: DATA SASARAN -->
        <div x-show="activeTab === 'target'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Data Sasaran Desa / Kelurahan</h2>
                    <p class="text-xs text-slate-500">Mencatat jumlah penduduk, keluarga, remaja putri, dan balita.</p>
                </div>
            </div>

            <!-- Form Tambah Target -->
            <form action="{{ route('target.store') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-6 grid grid-cols-1 sm:grid-cols-6 gap-3">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-600 mb-1">Nama Desa / Kelurahan</label>
                    <input type="text" name="village_name" required placeholder="Contoh: Singaparna" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Jml Penduduk</label>
                    <input type="number" name="population_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Jml KK</label>
                    <input type="number" name="family_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Remaja Putri</label>
                    <input type="number" name="young_female_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Balita</label>
                    <input type="number" name="children_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="sm:col-span-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Data Sasaran
                    </button>
                </div>
            </form>

            <!-- Table Target -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase text-xs">
                            <th class="p-3 rounded-l-lg">Desa / Kelurahan</th>
                            <th class="p-3">Penduduk</th>
                            <th class="p-3">Keluarga (KK)</th>
                            <th class="p-3">Remaja Putri</th>
                            <th class="p-3">Balita</th>
                            <th class="p-3 rounded-r-lg text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($targetData as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-semibold text-slate-800">{{ $item->village_name }}</td>
                                <td class="p-3">{{ number_format($item->population_count) }}</td>
                                <td class="p-3">{{ number_format($item->family_count) }}</td>
                                <td class="p-3">{{ number_format($item->young_female_count) }}</td>
                                <td class="p-3">{{ number_format($item->children_count) }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('target.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data sasaran ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-400">Belum ada data sasaran terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: DATA PENDUKUNG -->
        <div x-show="activeTab === 'support'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Data Pendukung Sarana & Prasarana</h2>
                    <p class="text-xs text-slate-500">Mencatat PAUD, Sekolah, dan Guru PAUD.</p>
                </div>
            </div>

            <!-- Form Tambah Support -->
            <form action="{{ route('support.store') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-6 grid grid-cols-1 sm:grid-cols-6 gap-3">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-600 mb-1">Nama Desa / Kelurahan</label>
                    <input type="text" name="village_name" required placeholder="Contoh: Singaparna" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Jml PAUD</label>
                    <input type="number" name="paud_institution_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">SMP / MTs</label>
                    <input type="number" name="smp_mts_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">SMA / MA</label>
                    <input type="number" name="sma_ma_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Guru PAUD</label>
                    <input type="number" name="paud_teacher_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="sm:col-span-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Data Pendukung
                    </button>
                </div>
            </form>

            <!-- Table Support -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase text-xs">
                            <th class="p-3 rounded-l-lg">Desa / Kelurahan</th>
                            <th class="p-3">Jml PAUD</th>
                            <th class="p-3">SMP / MTs</th>
                            <th class="p-3">SMA / MA</th>
                            <th class="p-3">Guru PAUD</th>
                            <th class="p-3 rounded-r-lg text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($supportData as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-semibold text-slate-800">{{ $item->village_name }}</td>
                                <td class="p-3">{{ number_format($item->paud_institution_count) }}</td>
                                <td class="p-3">{{ number_format($item->smp_mts_count) }}</td>
                                <td class="p-3">{{ number_format($item->sma_ma_count) }}</td>
                                <td class="p-3">{{ number_format($item->paud_teacher_count) }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('support.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data pendukung ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-400">Belum ada data pendukung terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 3: IDENTIFIKASI KENDALA -->
        <div x-show="activeTab === 'constraint'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-1">Identifikasi Kendala & Masalah</h2>
            <p class="text-xs text-slate-500 mb-6">Mencatat kendala, rekomendasi, serta perkiraan anggaran yang dibutuhkan.</p>

            <!-- Form Constraint -->
            <form action="{{ route('constraint.store') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Bidang / Cakupan</label>
                    <input type="text" name="scope" required placeholder="Contoh: Pelayanan Kesehatan" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Rencana Lokasi</label>
                    <input type="text" name="location_plan" required placeholder="Contoh: Posyandu Mawar" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Permasalahan</label>
                    <textarea name="problem" required rows="2" placeholder="Jelaskan masalah..." class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Penyebab</label>
                    <textarea name="cause" required rows="2" placeholder="Penyebab utama..." class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Rekomendasi / Solusi</label>
                    <textarea name="recommendation" required rows="2" placeholder="Rekomendasi tindak lanjut..." class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Penilaian / Assessment</label>
                        <input type="text" name="assessment" required placeholder="Sangat Penting / Sedang" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Kebutuhan Biaya (Rp)</label>
                        <input type="number" name="budget_needed" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Identifikasi Kendala
                    </button>
                </div>
            </form>

            <!-- Table Constraint -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase text-xs">
                            <th class="p-3 rounded-l-lg">Cakupan / Lokasi</th>
                            <th class="p-3">Masalah & Penyebab</th>
                            <th class="p-3">Rekomendasi</th>
                            <th class="p-3">Biaya Needed</th>
                            <th class="p-3 rounded-r-lg text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($constraints as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <div class="font-semibold text-slate-800">{{ $item->scope }}</div>
                                    <div class="text-xs text-slate-400"><i class="fa-solid fa-location-dot"></i> {{ $item->location_plan }}</div>
                                </td>
                                <td class="p-3">
                                    <div class="text-slate-800 font-medium">{{ $item->problem }}</div>
                                    <div class="text-xs text-rose-500">Penyebab: {{ $item->cause }}</div>
                                </td>
                                <td class="p-3 text-slate-700">{{ $item->recommendation }}</td>
                                <td class="p-3 font-semibold text-emerald-600">Rp {{ number_format($item->budget_needed) }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('constraint.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kendala ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-slate-400">Belum ada identifikasi kendala terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 4: PENYEDIAAN ANGGARAN -->
        <div x-show="activeTab === 'budget'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-1">Penyediaan Anggaran Program</h2>
            <p class="text-xs text-slate-500 mb-6">Mencatat alokasi anggaran berdasarkan indikator kinerja.</p>

            <form action="{{ route('budget.store') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-6 grid grid-cols-1 sm:grid-cols-4 gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Kode / ID Indikator</label>
                    <input type="text" name="indicator_id" required placeholder="IND-01" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Nama Indikator</label>
                    <input type="text" name="indicator_name" required placeholder="Pemberian PMT Balita" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Jumlah Anggaran (Rp)</label>
                    <input type="number" name="amount" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold text-slate-600 mb-1">Deskripsi Kegiatan</label>
                    <textarea name="activity_description" required rows="2" placeholder="Penjelasan rincian kegiatan..." class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div class="sm:col-span-4 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Anggaran
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase text-xs">
                            <th class="p-3 rounded-l-lg">Kode</th>
                            <th class="p-3">Nama Indikator</th>
                            <th class="p-3">Deskripsi Kegiatan</th>
                            <th class="p-3">Jumlah Anggaran</th>
                            <th class="p-3 rounded-r-lg text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($budgets as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-mono font-bold text-indigo-600">{{ $item->indicator_id }}</td>
                                <td class="p-3 font-semibold text-slate-800">{{ $item->indicator_name }}</td>
                                <td class="p-3 text-slate-600">{{ $item->activity_description }}</td>
                                <td class="p-3 font-bold text-emerald-600">Rp {{ number_format($item->amount) }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('budget.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data anggaran ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-slate-400">Belum ada data anggaran terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 5: CAPAIAN LAYANAN -->
        <div x-show="activeTab === 'service'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-1">Capaian Layanan</h2>
            <p class="text-xs text-slate-500 mb-6">Mencatatkan penerima KIA dan Bantuan Pangan per Desa.</p>

            <form action="{{ route('service.store') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Desa / Kelurahan</label>
                    <input type="text" name="village_name" required placeholder="Contoh: Singaparna" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Penerima Kelahiran / KIA</label>
                    <input type="number" name="birth_kia_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">Penerima Program Pangan</label>
                    <input type="number" name="food_program_count" min="0" required placeholder="0" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="sm:col-span-3 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Capaian Layanan
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 uppercase text-xs">
                            <th class="p-3 rounded-l-lg">Desa / Kelurahan</th>
                            <th class="p-3">Capaian KIA</th>
                            <th class="p-3">Capaian Program Pangan</th>
                            <th class="p-3 rounded-r-lg text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($serviceData as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-semibold text-slate-800">{{ $item->village_name }}</td>
                                <td class="p-3">{{ number_format($item->birth_kia_count) }} jiwa</td>
                                <td class="p-3">{{ number_format($item->food_program_count) }} keluarga</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('service.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data capaian layanan ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400">Belum ada data capaian layanan terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 6: MAKAN BERGIZI GRATIS (MBG) -->
        <div x-show="activeTab === 'mbg'" x-cloak class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mt-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Program Makan Bergizi Gratis (MBG)</h2>
                    <p class="text-xs text-slate-500">Mencatat pendistribusian makanan bergizi harian untuk balita, ibu hamil, dan anak PAUD per desa.</p>
                </div>
            </div>

            <form action="{{ route('mbg.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-6">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Desa / Kelurahan</label>
                    <input type="text" name="nama_desa" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Singaparna" required>
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Penerima Balita</label>
                    <input type="number" name="penerima_balita" value="0" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Penerima Bumil</label>
                    <input type="number" name="penerima_bumil" value="0" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Penerima PAUD</label>
                    <input type="number" name="penerima_paud" value="0" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Porsi Harian</label>
                    <input type="number" name="porsi_terdistribusi_harian" value="0" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Status Layanan</label>
                    <select name="status_layanan" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
                        <option value="Lancar">Lancar</option>
                        <option value="Kendala Distribusi">Kendala Distribusi</option>
                        <option value="Perlu Evaluasi">Perlu Evaluasi</option>
                    </select>
                </div>
                <div class="sm:col-span-4">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan Dapur / Lapangan</label>
                    <input type="text" name="catatan_dapur" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Catatan kendala pengiriman atau menu porsi...">
                </div>
                <div class="sm:col-span-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Data MBG
                    </button>
                </div>
            </form>

            <!-- Table MBG -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="p-3">Desa</th>
                            <th class="p-3">Balita</th>
                            <th class="p-3">Bumil</th>
                            <th class="p-3">PAUD</th>
                            <th class="p-3">Porsi Harian</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($mbgData as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-medium text-slate-800">{{ $item->nama_desa }}</td>
                            <td class="p-3">{{ $item->penerima_balita }}</td>
                            <td class="p-3">{{ $item->penerima_bumil }}</td>
                            <td class="p-3">{{ $item->penerima_paud }}</td>
                            <td class="p-3">{{ $item->porsi_terdistribusi_harian }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->status_layanan == 'Lancar' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $item->status_layanan }}
                                </span>
                            </td>
                            <td class="p-3 text-right">
                                <form action="{{ route('mbg.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-slate-400">Belum ada data MBG.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-slate-200 mt-12 py-6 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Stunting Singaparna — Sistem Informasi Monitoring Stunting.
    </footer>

</body>
</html>