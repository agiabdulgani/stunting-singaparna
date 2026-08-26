<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Sistem Monitoring Stunting Singaparna</title>

    <meta name="description"
          content="Sistem Informasi Monitoring Stunting Kecamatan Singaparna">

    <!-- FontAwesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100">

    <div class="min-h-screen flex">

        <!-- ==========================================
             LEFT SIDE - INFORMATION
        =========================================== -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden
                    bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500
                    text-white">

            <!-- Decorative Circle -->
            <div class="absolute -top-24 -left-24 w-72 h-72
                        rounded-full bg-white/10"></div>

            <div class="absolute -bottom-32 -right-20 w-96 h-96
                        rounded-full bg-white/10"></div>

            <div class="relative z-10 flex flex-col justify-center
                        px-16 xl:px-24">

                <!-- Logo -->
                <div class="flex items-center gap-4 mb-8">

                    <div class="w-16 h-16 rounded-2xl
                                bg-white/15 backdrop-blur-sm
                                flex items-center justify-center
                                border border-white/20 shadow-lg">

                        <i class="fa-solid fa-heart-pulse text-3xl"></i>

                    </div>

                    <div>
                        <p class="text-sm font-medium text-blue-100">
                            SISTEM INFORMASI
                        </p>

                        <h1 class="text-2xl font-bold">
                            Monitoring Stunting
                        </h1>
                    </div>

                </div>

                <!-- Heading -->
                <h2 class="text-4xl xl:text-5xl font-bold leading-tight mb-5">
                    Data Terpadu untuk
                    <span class="text-cyan-200">
                        Desa yang Lebih Sehat.
                    </span>
                </h2>

                <p class="text-blue-100 leading-relaxed max-w-lg">
                    Sistem informasi untuk membantu pengelolaan,
                    pemantauan, dan pelaporan data stunting di
                    wilayah Kecamatan Singaparna secara lebih
                    terstruktur dan terintegrasi.
                </p>

                <!-- Feature -->
                <div class="grid grid-cols-2 gap-4 mt-10 max-w-lg">

                    <div class="bg-white/10 backdrop-blur-sm
                                rounded-xl p-4 border border-white/10">

                        <i class="fa-solid fa-chart-line text-xl mb-3"></i>

                        <p class="font-semibold">
                            Monitoring Data
                        </p>

                        <p class="text-xs text-blue-100 mt-1">
                            Pantau perkembangan data secara terstruktur.
                        </p>

                    </div>

                    <div class="bg-white/10 backdrop-blur-sm
                                rounded-xl p-4 border border-white/10">

                        <i class="fa-solid fa-database text-xl mb-3"></i>

                        <p class="font-semibold">
                            Data Terintegrasi
                        </p>

                        <p class="text-xs text-blue-100 mt-1">
                            Kelola data desa dalam satu sistem.
                        </p>

                    </div>

                </div>

                <!-- Footer -->
                <div class="mt-12 text-xs text-blue-100">
                    © {{ date('Y') }}
                    Sistem Informasi Monitoring Stunting Singaparna
                </div>

            </div>
        </div>


        <!-- ==========================================
             RIGHT SIDE - LOGIN
        =========================================== -->
        <div class="w-full lg:w-1/2 flex items-center
                    justify-center p-6 sm:p-10">

            <div class="w-full max-w-md">

                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">

                    <div class="inline-flex items-center justify-center
                                w-16 h-16 rounded-2xl
                                bg-blue-100 text-blue-600 mb-4">

                        <i class="fa-solid fa-heart-pulse text-3xl"></i>

                    </div>

                    <h1 class="text-2xl font-bold text-slate-800">
                        Monitoring Stunting
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        Kecamatan Singaparna
                    </p>

                </div>


                <!-- Login Card -->
                <div class="bg-white rounded-3xl
                            shadow-xl shadow-slate-200/70
                            border border-slate-200
                            p-7 sm:p-9">

                    <!-- Header -->
                    <div class="mb-7">

                        <p class="text-sm font-semibold text-blue-600 mb-2">
                            SELAMAT DATANG
                        </p>

                        <h2 class="text-3xl font-bold text-slate-800">
                            Login ke Sistem
                        </h2>

                        <p class="text-sm text-slate-500 mt-2">
                            Silakan masuk menggunakan akun petugas Anda.
                        </p>

                    </div>


                    <!-- Error -->
                    @if($errors->any())

                        <div class="mb-5 rounded-xl border
                                    border-red-200 bg-red-50
                                    px-4 py-3 text-sm text-red-700">

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-circle-exclamation
                                          mt-0.5 text-red-500"></i>

                                <div>
                                    <p class="font-semibold">
                                        Login gagal
                                    </p>

                                    <p class="mt-1">
                                        {{ $errors->first() }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- Session Status -->
                    @if(session('status'))

                        <div class="mb-5 rounded-xl border
                                    border-green-200 bg-green-50
                                    px-4 py-3 text-sm text-green-700">

                            <i class="fa-solid fa-circle-check mr-2"></i>

                            {{ session('status') }}

                        </div>

                    @endif


                    <!-- Form -->
                    <form
                        action="{{ route('login') }}"
                        method="POST"
                        class="space-y-5"
                    >

                        @csrf


                        <!-- Email -->
                        <div>

                            <label
                                for="email"
                                class="block text-sm font-semibold
                                       text-slate-700 mb-2"
                            >
                                Email
                            </label>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-slate-400">

                                    <i class="fa-solid fa-envelope"></i>

                                </div>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="admin@singaparna.go.id"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-4
                                           text-sm text-slate-800
                                           placeholder:text-slate-400
                                           transition
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none"
                                >

                            </div>

                            @error('email')

                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Password -->
                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <label
                                    for="password"
                                    class="text-sm font-semibold
                                           text-slate-700"
                                >
                                    Password
                                </label>

                                @if (Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        class="text-xs font-semibold
                                               text-blue-600
                                               hover:text-blue-700
                                               hover:underline"
                                    >
                                        Lupa password?
                                    </a>

                                @endif

                            </div>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-slate-400">

                                    <i class="fa-solid fa-lock"></i>

                                </div>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-12
                                           text-sm text-slate-800
                                           placeholder:text-slate-400
                                           transition
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0
                                           flex items-center px-4
                                           text-slate-400
                                           hover:text-blue-600"
                                    aria-label="Tampilkan password"
                                >
                                    <i
                                        id="passwordIcon"
                                        class="fa-solid fa-eye"
                                    ></i>
                                </button>

                            </div>

                            @error('password')

                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Remember -->
                        <div class="flex items-center">

                            <label class="flex items-center gap-2
                                          cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="w-4 h-4 rounded
                                           border-slate-300
                                           text-blue-600
                                           focus:ring-blue-500"
                                >

                                <span class="text-sm text-slate-600">
                                    Ingat saya
                                </span>

                            </label>

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="w-full rounded-xl
                                   bg-blue-600
                                   hover:bg-blue-700
                                   active:scale-[0.98]
                                   py-3.5
                                   text-sm font-bold text-white
                                   shadow-lg shadow-blue-200
                                   transition duration-200
                                   flex items-center justify-center gap-2"
                        >

                            <i class="fa-solid fa-right-to-bracket"></i>

                            <span>
                                MASUK KE DASHBOARD
                            </span>

                        </button>

                    </form>


                    <!-- Register -->
                    @if(Route::has('register'))

                        <div class="relative my-7">

                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t
                                            border-slate-200"></div>
                            </div>

                            <div class="relative flex justify-center">

                                <span class="bg-white px-4
                                             text-xs text-slate-400">
                                    atau
                                </span>

                            </div>

                        </div>

                        <p class="text-center text-sm text-slate-500">

                            Belum memiliki akun?

                            <a
                                href="{{ route('register') }}"
                                class="font-bold text-blue-600
                                       hover:text-blue-700
                                       hover:underline"
                            >
                                Daftar sebagai Petugas
                            </a>

                        </p>

                    @endif

                </div>


                <!-- Security Notice -->
                <div class="flex items-center justify-center
                            gap-2 mt-5 text-xs text-slate-400">

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>
                        Akses aman untuk pengguna terdaftar
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- Password Toggle -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>