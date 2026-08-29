<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — HVM Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="antialiased bg-white min-h-screen flex text-[#111827]">

    {{-- KIRI: Banner / Brand Area --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-[#075749] relative flex-col justify-between p-12 overflow-hidden">
        {{-- Background Pattern/Glow --}}
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:50px_50px]"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#9acb03] rounded-full blur-[100px] opacity-20"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-[#9acb03] flex items-center justify-center rounded-xl text-[#0d1f15] font-bold text-xl">H</div>
                <span class="text-white font-bold text-xl tracking-wide">HVM Digital</span>
            </div>

            <h1 class="text-white text-5xl xl:text-6xl font-black leading-[1.1] tracking-tight mb-6">
                Hello<br>
                Admin!<span class="ml-3 inline-block animate-wave origin-bottom-right">👋</span>
            </h1>

            <p class="text-white/70 text-lg font-light leading-relaxed max-w-md">
                Selamat datang kembali di panel manajemen. Kelola website, artikel, pengguna, dan event Megpreneur dengan mudah melalui satu pintu.
            </p>
        </div>

        <div class="relative z-10 text-white/40 text-sm font-light">
            &copy; {{ date('Y') }} HVM Digital. All rights reserved.
        </div>
    </div>

    {{-- KANAN: Login Form --}}
    <div class="w-full lg:w-7/12 xl:w-1/2 flex flex-col justify-center px-6 sm:px-12 md:px-24 lg:px-20 xl:px-32 relative">
        {{-- Mobile Logo (Hanya tampil di mobile) --}}
        <div class="lg:hidden flex items-center gap-3 mb-10">
            <div class="w-10 h-10 bg-[#075749] flex items-center justify-center rounded-xl text-white font-bold text-xl">H</div>
            <span class="text-[#111827] font-bold text-xl tracking-wide">HVM Digital</span>
        </div>

        <div class="w-full max-w-md">
            <h2 class="text-3xl font-bold text-[#111827] mb-2">Welcome Back!</h2>
            <p class="text-gray-500 font-light text-sm mb-10">
                Akses panel admin dibatasi hanya untuk staf internal.<br>
                <a href="{{ route('home') }}" class="text-[#075749] font-medium hover:underline">Kembali ke halaman utama</a>.
            </p>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <div>{{ session('success') }}</div>
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-xl mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                {{-- Username Field --}}
                <div class="space-y-2">
                    <label class="block text-gray-700 text-sm font-medium">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-[#075749] transition-colors placeholder-gray-400 font-medium text-[#111827]"
                           placeholder="Masukkan username anda">
                    @error('username')<p class="text-red-500 text-xs font-medium mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Password Field --}}
                <div class="space-y-2 pt-2">
                    <label class="block text-gray-700 text-sm font-medium">Password</label>
                    <input type="password" name="password" required
                           class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-[#075749] transition-colors placeholder-gray-400 font-medium text-[#111827]"
                           placeholder="Masukkan password anda">
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-[#111827] text-white font-semibold py-4 rounded-xl hover:bg-[#1f2937] transition-all duration-200 shadow-md">
                        Login Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes wave {
            0% { transform: rotate(0.0deg) }
            10% { transform: rotate(14.0deg) }
            20% { transform: rotate(-8.0deg) }
            30% { transform: rotate(14.0deg) }
            40% { transform: rotate(-4.0deg) }
            50% { transform: rotate(10.0deg) }
            60% { transform: rotate(0.0deg) }
            100% { transform: rotate(0.0deg) }
        }
        .animate-wave {
            animation: wave 2.5s infinite;
        }
    </style>
</body>
</html>
