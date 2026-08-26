<div class="min-h-screen bg-slate-100">

    <!-- Header -->
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Dashboard
                    </h1>

                    <p class="text-sm text-slate-500">
                        Sistem Informasi Monitoring Stunting Singaparna
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100
                                flex items-center justify-center
                                text-blue-600">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-slate-700">
                            {{ auth()->user()->name ?? 'Petugas' }}
                        </p>

                        <p class="text-xs text-slate-500">
                            {{ auth()->user()->role ?? 'Operator' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">

        <div class="bg-white rounded-2xl border border-slate-200
                    shadow-sm p-6">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-100
                            flex items-center justify-center
                            text-blue-600">

                    <i class="fa-solid fa-heart-pulse text-xl"></i>

                </div>

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Selamat Datang
                    </h2>

                    <p class="text-sm text-slate-500">
                        Selamat datang di Sistem Informasi
                        Monitoring Stunting Singaparna.
                    </p>
                </div>

            </div>

        </div>

    </main>

</div>