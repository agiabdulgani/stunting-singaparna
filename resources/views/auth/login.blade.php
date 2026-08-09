<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stunting Singaparna</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-200">
        <!-- Logo & Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-blue-100 text-blue-600 mb-3 shadow-inner">
                <i class="fa-solid fa-heart-pulse text-3xl text-red-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Login Admin</h2>
            <p class="text-xs text-slate-500 mt-1">Sistem Informasi Monitoring Stunting Singaparna</p>
        </div>

        <!-- Notifikasi Error -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email / Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" required placeholder="admin@singaparna.go.id" value="{{ old('email') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none text-sm transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none text-sm transition">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-bold py-3 rounded-xl shadow-md transition duration-200 flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>MASUK KE DASHBOARD</span>
            </button>
        </form>

        <!-- Banner Info Pembayaran DANA -->
        <div class="mt-6 p-3.5 bg-sky-50 border border-sky-200 rounded-xl flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-sky-500 text-white rounded-lg flex items-center justify-center font-bold text-xs tracking-wider shadow">
                    DANA
                </div>
                <div>
                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Info Pembayaran / Donasi</p>
                    <p class="text-sm font-extrabold text-sky-700 tracking-wider">085795308193</p>
                </div>
            </div>
            <button onclick="navigator.clipboard.writeText('085795308193'); alert('Nomor DANA berhasil disalin!');" 
                    class="text-xs bg-white hover:bg-sky-100 text-sky-700 font-bold px-2.5 py-1.5 border border-sky-300 rounded-lg shadow-sm transition active:scale-95">
                Salin
            </button>
        </div>

        <!-- Footer Register Link -->
        <p class="text-center text-xs text-slate-500 mt-5">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Petugas</a>
        </p>
    </div>

</body>
</html>