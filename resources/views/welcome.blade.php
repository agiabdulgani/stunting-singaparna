<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'SIMONITA') }}</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800"
          rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg">
                    <i class="fa-solid fa-heart-pulse text-xl"></i>
                </div>

                <div>
                    <h1 class="text-lg font-extrabold tracking-tight text-slate-900">
                        SIMONITA
                    </h1>
                    <p class="text-[10px] font-medium uppercase tracking-wider text-slate-500">
                        Monitoring Stunting Singaparna
                    </p>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="flex items-center gap-2 sm:gap-3">

                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="hidden rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 sm:inline-flex">
                        <i class="fa-solid fa-chart-line mr-2"></i>
                        Dashboard
                    </a>
                @else

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-blue-600">
                            <i class="fa-solid fa-right-to-bracket mr-1.5"></i>
                            Login
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                            <i class="fa-solid fa-user-plus mr-1.5"></i>
                            <span class="hidden sm:inline">Daftar</span>
                        </a>
                    @endif

                @endauth

            </nav>
        </div>
    </header>


    <!-- ================= HERO ================= -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500">

        <!-- Decorative -->
        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white/10"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 py-16 lg:grid-cols-2 lg:px-8 lg:py-20">

            <!-- Hero Text -->
            <div class="text-white">

                <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-medium backdrop-blur">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-300"></span>
                    Sistem Informasi Kecamatan Singaparna
                </div>

                <h2 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">
                    Monitoring Data
                    <span class="text-cyan-200">
                        Stunting
                    </span>
                    Secara Terintegrasi
                </h2>

                <p class="mt-5 max-w-xl text-base leading-7 text-blue-100 sm:text-lg">
                    SIMONITA membantu petugas dalam mengelola, memantau,
                    dan menganalisis data stunting di wilayah Kecamatan
                    Singaparna secara lebih cepat, terstruktur, dan efisien.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">

                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="inline-flex items-center rounded-xl bg-white px-5 py-3 font-bold text-blue-700 shadow-lg transition hover:bg-blue-50">
                            <i class="fa-solid fa-gauge-high mr-2"></i>
                            Buka Dashboard
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center rounded-xl bg-white px-5 py-3 font-bold text-blue-700 shadow-lg transition hover:bg-blue-50">
                                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                                Mulai Sekarang
                            </a>
                        @endif
                    @endauth

                    <a href="#lokasi"
                       class="inline-flex items-center rounded-xl border border-white/30 bg-white/10 px-5 py-3 font-bold text-white backdrop-blur transition hover:bg-white/20">
                        <i class="fa-solid fa-location-dot mr-2"></i>
                        Lihat Lokasi
                    </a>

                </div>
            </div>


            <!-- Hero Illustration -->
            <div class="hidden lg:flex lg:justify-end">
                <div class="relative">

                    <div class="flex h-80 w-80 items-center justify-center rounded-full bg-white/10 backdrop-blur">
                        <div class="flex h-60 w-60 items-center justify-center rounded-full bg-white shadow-2xl">
                            <div class="text-center">

                                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-3xl bg-blue-100 text-blue-600">
                                    <i class="fa-solid fa-heart-pulse text-4xl"></i>
                                </div>

                                <h3 class="text-xl font-extrabold text-slate-800">
                                    SIMONITA
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Data • Monitoring • Laporan
                                </p>

                            </div>
                        </div>
                    </div>

                    <!-- Floating Card -->
                    <div class="absolute -bottom-4 -left-10 rounded-2xl bg-white p-4 shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>

                            <div>
                                <p class="text-xs text-slate-500">
                                    Monitoring
                                </p>
                                <p class="font-bold text-slate-800">
                                    Data Terintegrasi
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- ================= FEATURES ================= -->
    <section class="bg-white py-14">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-bold uppercase tracking-wider text-blue-600">
                    Fitur Sistem
                </span>

                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                    Semua Data dalam Satu Sistem
                </h2>

                <p class="mt-3 text-slate-500">
                    SIMONITA menyediakan berbagai fitur untuk mendukung
                    pengelolaan data stunting di wilayah Singaparna.
                </p>
            </div>


            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Feature 1 -->
                <div class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-blue-200 hover:bg-white hover:shadow-xl">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                        <i class="fa-solid fa-database text-xl"></i>
                    </div>

                    <h3 class="font-bold text-slate-900">
                        Data Terpusat
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Pengelolaan data sasaran, pendukung, layanan,
                        dan individu dalam satu sistem.
                    </p>

                </div>


                <!-- Feature 2 -->
                <div class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-emerald-200 hover:bg-white hover:shadow-xl">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">
                        <i class="fa-solid fa-chart-pie text-xl"></i>
                    </div>

                    <h3 class="font-bold text-slate-900">
                        Monitoring
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Memantau kondisi dan perkembangan data stunting
                        secara lebih mudah.
                    </p>

                </div>


                <!-- Feature 3 -->
                <div class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-orange-200 hover:bg-white hover:shadow-xl">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600 transition group-hover:bg-orange-600 group-hover:text-white">
                        <i class="fa-solid fa-file-lines text-xl"></i>
                    </div>

                    <h3 class="font-bold text-slate-900">
                        Laporan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Membantu menghasilkan laporan data untuk kebutuhan
                        monitoring dan evaluasi.
                    </p>

                </div>


                <!-- Feature 4 -->
                <div class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-purple-200 hover:bg-white hover:shadow-xl">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-purple-600 transition group-hover:bg-purple-600 group-hover:text-white">
                        <i class="fa-solid fa-shield-halved text-xl"></i>
                    </div>

                    <h3 class="font-bold text-slate-900">
                        Akses Petugas
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Sistem login untuk menjaga keamanan akses
                        pengelolaan data.
                    </p>

                </div>

            </div>

        </div>
    </section>


    <!-- ================= MAP ================= -->
    <section id="lokasi" class="bg-slate-100 py-14">

        <div class="mx-auto max-w-7xl px-5 lg:px-8">

            <div class="mb-8">
                <span class="text-sm font-bold uppercase tracking-wider text-blue-600">
                    Lokasi Wilayah
                </span>

                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                    Kecamatan Singaparna
                </h2>

                <p class="mt-2 max-w-2xl text-slate-500">
                    Peta lokasi wilayah Kecamatan Singaparna,
                    Kabupaten Tasikmalaya.
                </p>
            </div>


            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl">

                <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800">
                            Peta Wilayah Singaparna
                        </h3>

                        <p class="text-xs text-slate-500">
                            Kabupaten Tasikmalaya, Jawa Barat
                        </p>
                    </div>

                </div>


                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.213075489736!2d107.5186!3d-7.3556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f432070f862cd%3A0x401e8f1fc28b570!2sSingaparna%2C%20Tasikmalaya%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1650000000000!5m2!1sen!2sid"
                    width="100%"
                    height="420"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->
    <section class="bg-white py-14">

        <div class="mx-auto max-w-4xl px-5 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                <i class="fa-solid fa-heart-pulse text-3xl"></i>
            </div>

            <h2 class="mt-5 text-3xl font-extrabold text-slate-900">
                Siap Mengelola Data Stunting?
            </h2>

            <p class="mx-auto mt-3 max-w-xl text-slate-500">
                Gunakan SIMONITA untuk membantu proses pengelolaan,
                monitoring, dan pelaporan data stunting di Kecamatan Singaparna.
            </p>

            <div class="mt-7 flex justify-center gap-3">

                @auth

                    <a href="{{ url('/dashboard') }}"
                       class="rounded-xl bg-blue-600 px-6 py-3 font-bold text-white shadow-lg transition hover:bg-blue-700">
                        <i class="fa-solid fa-chart-line mr-2"></i>
                        Buka Dashboard
                    </a>

                @else

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="rounded-xl bg-blue-600 px-6 py-3 font-bold text-white shadow-lg transition hover:bg-blue-700">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i>
                            Login Petugas
                        </a>
                    @endif

                @endauth

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="border-t border-slate-200 bg-slate-900 text-slate-300">

        <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

            <div class="grid gap-8 md:grid-cols-3">

                <!-- Brand -->
                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>

                        <div>
                            <h3 class="font-extrabold text-white">
                                SIMONITA
                            </h3>

                            <p class="text-xs text-slate-400">
                                Monitoring Stunting Singaparna
                            </p>
                        </div>

                    </div>

                    <p class="mt-4 max-w-sm text-sm leading-6 text-slate-400">
                        Sistem informasi untuk membantu pengelolaan,
                        monitoring, dan pelaporan data stunting
                        di wilayah Kecamatan Singaparna.
                    </p>

                </div>


                <!-- Sistem -->
                <div>

                    <h4 class="font-bold text-white">
                        Sistem
                    </h4>

                    <ul class="mt-4 space-y-3 text-sm text-slate-400">

                        <li>
                            <i class="fa-solid fa-database mr-2 text-blue-400"></i>
                            Data Sasaran
                        </li>

                        <li>
                            <i class="fa-solid fa-users mr-2 text-blue-400"></i>
                            Data Individu
                        </li>

                        <li>
                            <i class="fa-solid fa-chart-line mr-2 text-blue-400"></i>
                            Monitoring
                        </li>

                        <li>
                            <i class="fa-solid fa-file-pdf mr-2 text-blue-400"></i>
                            Laporan
                        </li>

                    </ul>

                </div>


                <!-- Informasi -->
                <div>

                    <h4 class="font-bold text-white">
                        Wilayah
                    </h4>

                    <ul class="mt-4 space-y-3 text-sm text-slate-400">

                        <li>
                            <i class="fa-solid fa-location-dot mr-2 text-blue-400"></i>
                            Kecamatan Singaparna
                        </li>

                        <li>
                            <i class="fa-solid fa-map mr-2 text-blue-400"></i>
                            Kabupaten Tasikmalaya
                        </li>

                        <li>
                            <i class="fa-solid fa-location-crosshairs mr-2 text-blue-400"></i>
                            Jawa Barat
                        </li>

                    </ul>

                </div>

            </div>


            <div class="mt-10 border-t border-slate-700 pt-6 text-center text-xs text-slate-500">

                © {{ date('Y') }}
                <span class="font-semibold text-slate-300">SIMONITA</span>.
                Sistem Informasi Monitoring Stunting Singaparna.

            </div>

        </div>

    </footer>

</body>
</html>