<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — HVM Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat antialiased bg-[#0a1f12] min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#9acb03]/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange/10 rounded-full blur-3xl animate-pulse" style="animation-delay:1s"></div>
    </div>
    <div class="absolute inset-0 bg-[linear-gradient(rgba(0,212,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(0,212,255,0.03)_1px,transparent_1px)] bg-[size:50px_50px]"></div>

    <div class="relative w-full max-w-md px-4">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 shadow-2xl">
            {{-- Logo --}}
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-[#075749] to-[#9acb03] rounded-2xl mb-5 shadow-lg shadow-cyan/30">
                    <span class="text-white font-bold text-2xl">H</span>
                </div>
                <h1 class="text-white font-bold text-2xl">HVM Digital</h1>
                <p class="text-white/40 font-light text-sm mt-1">Admin Panel</p>
            </div>

            @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/30 text-green-400 text-sm font-light px-4 py-3 rounded-xl mb-6">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm font-light px-4 py-3 rounded-xl mb-6">❌ {{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-white/50 text-xs font-medium tracking-wider uppercase mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-5 py-3.5 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-white/10 transition-all placeholder-white/20"
                           placeholder="Masukkan username">
                    @error('username')<p class="text-red-400 text-xs font-light mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-medium tracking-wider uppercase mb-2">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-5 py-3.5 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-white/10 transition-all placeholder-white/20"
                           placeholder="Masukkan password">
                </div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-[#075749] to-[#9acb03] text-navy font-semibold py-4 rounded-xl hover:shadow-lg hover:shadow-cyan/30 hover:scale-[1.02] transition-all duration-200 mt-2">
                    Masuk ke Admin Panel
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center">
                <a href="{{ route('home') }}" class="text-white/30 hover:text-[#9acb03] text-xs font-light transition-colors">← Kembali ke Website</a>
            </div>
        </div>
    </div>
</body>
</html>
