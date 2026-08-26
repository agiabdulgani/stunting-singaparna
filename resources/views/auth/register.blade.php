<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Petugas | Monitoring Stunting Singaparna</title>

    <meta name="description"
          content="Pendaftaran akun petugas Sistem Informasi Monitoring Stunting Kecamatan Singaparna">

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
             LEFT SIDE
        =========================================== -->
        <div class="hidden lg:flex lg:w-5/12 relative overflow-hidden
                    bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500
                    text-white">

            <!-- Decorative Elements -->
            <div class="absolute -top-28 -left-28
                        w-80 h-80 rounded-full
                        bg-white/10"></div>

            <div class="absolute -bottom-40 -right-24
                        w-[28rem] h-[28rem] rounded-full
                        bg-white/10"></div>

            <div class="relative z-10 flex flex-col
                        justify-center px-14 xl:px-20">

                <!-- Logo -->
                <div class="flex items-center gap-4 mb-8">

                    <div class="w-16 h-16 rounded-2xl
                                bg-white/15 backdrop-blur-sm
                                border border-white/20
                                flex items-center justify-center
                                shadow-lg">

                        <i class="fa-solid fa-user-shield text-3xl"></i>

                    </div>

                    <div>

                        <p class="text-xs font-semibold
                                  tracking-wider text-blue-100">
                            SISTEM INFORMASI
                        </p>

                        <h1 class="text-2xl font-bold">
                            Monitoring Stunting
                        </h1>

                    </div>

                </div>


                <!-- Heading -->
                <h2 class="text-4xl font-bold leading-tight mb-5">

                    Bergabung sebagai
                    <span class="text-cyan-200">
                        Petugas
                    </span>

                </h2>

                <p class="text-blue-100 leading-relaxed max-w-md">

                    Buat akun petugas untuk mengakses sistem
                    pengelolaan dan monitoring data stunting
                    di Kecamatan Singaparna.

                </p>


                <!-- Information Cards -->
                <div class="space-y-3 mt-10 max-w-md">

                    <div class="flex items-center gap-4
                                rounded-xl
                                bg-white/10
                                backdrop-blur-sm
                                border border-white/10
                                p-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-white/10
                                    flex items-center justify-center">

                            <i class="fa-solid fa-database"></i>

                        </div>

                        <div>

                            <p class="font-semibold">
                                Data Terintegrasi
                            </p>

                            <p class="text-xs text-blue-100 mt-1">
                                Kelola data dalam satu sistem.
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4
                                rounded-xl
                                bg-white/10
                                backdrop-blur-sm
                                border border-white/10
                                p-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-white/10
                                    flex items-center justify-center">

                            <i class="fa-solid fa-chart-line"></i>

                        </div>

                        <div>

                            <p class="font-semibold">
                                Monitoring Lebih Mudah
                            </p>

                            <p class="text-xs text-blue-100 mt-1">
                                Pantau informasi secara terstruktur.
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4
                                rounded-xl
                                bg-white/10
                                backdrop-blur-sm
                                border border-white/10
                                p-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-white/10
                                    flex items-center justify-center">

                            <i class="fa-solid fa-shield-halved"></i>

                        </div>

                        <div>

                            <p class="font-semibold">
                                Akses Terlindungi
                            </p>

                            <p class="text-xs text-blue-100 mt-1">
                                Akun digunakan sesuai kewenangan petugas.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="mt-10 text-xs text-blue-100">

                    © {{ date('Y') }}
                    Sistem Informasi Monitoring Stunting Singaparna

                </div>

            </div>

        </div>


        <!-- ==========================================
             RIGHT SIDE
        =========================================== -->
        <div class="w-full lg:w-7/12
                    flex items-center justify-center
                    p-5 sm:p-8 lg:p-12">

            <div class="w-full max-w-lg">


                <!-- Mobile Header -->
                <div class="lg:hidden text-center mb-7">

                    <div class="inline-flex items-center justify-center
                                w-16 h-16 rounded-2xl
                                bg-blue-100 text-blue-600 mb-4">

                        <i class="fa-solid fa-user-plus text-3xl"></i>

                    </div>

                    <h1 class="text-2xl font-bold text-slate-800">
                        Daftar Petugas
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        Monitoring Stunting Singaparna
                    </p>

                </div>


                <!-- Register Card -->
                <div class="bg-white
                            rounded-3xl
                            border border-slate-200
                            shadow-xl shadow-slate-200/70
                            p-7 sm:p-9">

                    <!-- Header -->
                    <div class="mb-7">

                        <p class="text-sm font-semibold
                                  text-blue-600 mb-2">

                            PENDAFTARAN PETUGAS

                        </p>

                        <h2 class="text-3xl font-bold text-slate-800">

                            Buat Akun Baru

                        </h2>

                        <p class="text-sm text-slate-500 mt-2">

                            Lengkapi data berikut untuk membuat
                            akun petugas.

                        </p>

                    </div>


                    <!-- Error Notification -->
                    @if($errors->any())

                        <div class="mb-5 rounded-xl
                                    border border-red-200
                                    bg-red-50
                                    px-4 py-3
                                    text-sm text-red-700">

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-circle-exclamation
                                          mt-0.5 text-red-500"></i>

                                <div>

                                    <p class="font-semibold">
                                        Pendaftaran gagal
                                    </p>

                                    <ul class="mt-1 space-y-1">

                                        @foreach($errors->all() as $error)

                                            <li>
                                                {{ $error }}
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- Success -->
                    @if(session('success'))

                        <div class="mb-5 rounded-xl
                                    border border-green-200
                                    bg-green-50
                                    px-4 py-3
                                    text-sm text-green-700">

                            <i class="fa-solid fa-circle-check mr-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    <!-- Form -->
                    <form
                        action="{{ route('register') }}"
                        method="POST"
                        class="space-y-5"
                    >

                        @csrf


                        <!-- Name -->
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-semibold
                                       text-slate-700 mb-2"
                            >
                                Nama Lengkap
                            </label>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-slate-400">

                                    <i class="fa-solid fa-user"></i>

                                </div>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autocomplete="name"
                                    placeholder="Nama lengkap petugas"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-4
                                           text-sm
                                           placeholder:text-slate-400
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none
                                           transition"
                                >

                            </div>

                            @error('name')

                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


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
                                    placeholder="petugas@singaparna.go.id"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-4
                                           text-sm
                                           placeholder:text-slate-400
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none
                                           transition"
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

                            <label
                                for="password"
                                class="block text-sm font-semibold
                                       text-slate-700 mb-2"
                            >
                                Password
                            </label>

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
                                    autocomplete="new-password"
                                    placeholder="Minimal 8 karakter"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-12
                                           text-sm
                                           placeholder:text-slate-400
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none
                                           transition"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('password', 'passwordIcon')"
                                    class="absolute inset-y-0 right-0
                                           flex items-center px-4
                                           text-slate-400
                                           hover:text-blue-600"
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


                        <!-- Password Confirmation -->
                        <div>

                            <label
                                for="password_confirmation"
                                class="block text-sm font-semibold
                                       text-slate-700 mb-2"
                            >
                                Konfirmasi Password
                            </label>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-slate-400">

                                    <i class="fa-solid fa-shield-halved"></i>

                                </div>

                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Ulangi password"
                                    class="w-full rounded-xl
                                           border border-slate-300
                                           bg-slate-50
                                           py-3 pl-11 pr-12
                                           text-sm
                                           placeholder:text-slate-400
                                           focus:border-blue-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-blue-100
                                           focus:outline-none
                                           transition"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword(
                                        'password_confirmation',
                                        'confirmationIcon'
                                    )"
                                    class="absolute inset-y-0 right-0
                                           flex items-center px-4
                                           text-slate-400
                                           hover:text-blue-600"
                                >

                                    <i
                                        id="confirmationIcon"
                                        class="fa-solid fa-eye"
                                    ></i>

                                </button>

                            </div>

                            @error('password_confirmation')

                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Information -->
                        <div class="rounded-xl
                                    border border-blue-100
                                    bg-blue-50
                                    px-4 py-3">

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-circle-info
                                          text-blue-500 mt-0.5"></i>

                                <p class="text-xs leading-relaxed
                                          text-blue-700">

                                    Akun yang didaftarkan akan menggunakan
                                    hak akses petugas. Penentuan wilayah
                                    dan role dilakukan oleh administrator.

                                </p>

                            </div>

                        </div>


                        <!-- Terms -->
                        <label class="flex items-start gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="terms"
                                required
                                class="mt-0.5 w-4 h-4 rounded
                                       border-slate-300
                                       text-blue-600
                                       focus:ring-blue-500"
                            >

                            <span class="text-xs leading-relaxed
                                         text-slate-500">

                                Saya memastikan data yang saya masukkan
                                benar dan bersedia menggunakan sistem
                                sesuai kewenangan yang diberikan.

                            </span>

                        </label>


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

                            <i class="fa-solid fa-user-check"></i>

                            <span>
                                DAFTAR SEKARANG
                            </span>

                        </button>

                    </form>


                    <!-- Login -->
                    <div class="relative my-7">

                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t
                                        border-slate-200"></div>
                        </div>

                        <div class="relative flex justify-center">

                            <span class="bg-white px-4
                                         text-xs text-slate-400">
                                sudah memiliki akun?
                            </span>

                        </div>

                    </div>


                    <p class="text-center text-sm text-slate-500">

                        Sudah punya akun?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-blue-600
                                   hover:text-blue-700
                                   hover:underline"
                        >
                            Login sekarang
                        </a>

                    </p>

                </div>


                <!-- Security -->
                <div class="flex items-center justify-center
                            gap-2 mt-5 text-xs text-slate-400">

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>
                        Data akun dilindungi oleh sistem keamanan aplikasi
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- Password Toggle -->
    <script>
        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

            }
        }
    </script>

</body>
</html>