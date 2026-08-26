@extends('layouts.auth')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-[#f0fdf4] dark:bg-[#0a1510] relative overflow-hidden p-4 sm:p-8">
    {{-- Decorative glows (from homepage) --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#9acb03]/20 dark:bg-[#9acb03]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#075749]/10 dark:bg-[#075749]/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Modern Centered Card --}}
    <div class="w-full max-w-5xl bg-white dark:bg-[#0d1f15] rounded-3xl shadow-2xl overflow-hidden flex z-10 border border-[#075749]/5 dark:border-[#9acb03]/10">
        
        {{-- Left Side: Branding (Hidden on Mobile) --}}
        <div class="hidden lg:flex w-5/12 bg-[#0a1f12] p-12 flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-[#075749]/50 to-transparent"></div>
            
            {{-- Decorative pattern overlay --}}
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent bg-[length:20px_20px]"></div>

            <div class="relative z-10">
                <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105">
                    @php
                        $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                    @endphp
                    <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'HVM Digital') }}" class="h-10 w-auto">
                </a>
            </div>
            
            <div class="relative z-10 mt-16 mb-auto">
                <h1 class="text-4xl xl:text-5xl font-bold text-white leading-tight mb-6 tracking-tight">
                    Kelola Bisnis <br>
                    <span class="text-[#9acb03]">Lebih Mudah.</span>
                </h1>
                <p class="text-white/80 text-sm leading-relaxed font-light">
                    Masuk ke dashboard untuk mengelola konten website, melihat pesanan, dan memantau perkembangan UMKM Anda bersama HVM Digital.
                </p>
            </div>
            
            <div class="relative z-10 text-white/50 text-xs font-light tracking-wide">
                &copy; {{ date('Y') }} PT HVM Orbit Studios
            </div>
        </div>

        {{-- Right Side: Login Form --}}
        <div class="w-full lg:w-7/12 p-8 sm:p-12 xl:p-16 flex flex-col justify-center relative">
            <div class="text-center lg:text-left mb-8">
                {{-- Mobile Logo --}}
                <div class="lg:hidden mb-10 text-center flex justify-center">
                    <a href="{{ route('home') }}" class="inline-block">
                        @php
                            // Force dark logo on light bg if available
                            $mobileLogo = setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png');
                        @endphp
                        <img src="{{ $mobileLogo }}" alt="HVM Digital" class="h-10 w-auto">
                    </a>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light">Gunakan email dan password terdaftar Anda.</p>
            </div>

            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 text-[#075749] dark:bg-green-500/10 dark:text-green-400 text-sm font-medium border border-green-200 dark:border-green-500/20">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-400 text-sm font-medium border border-red-200 dark:border-red-500/20">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] mb-1.5 uppercase tracking-widest">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3.5 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                        placeholder="nama@email.com">
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-[#075749] dark:text-[#9acb03] uppercase tracking-widest">Password</label>
                        <a href="#" class="text-xs text-[#075749] dark:text-[#9acb03] hover:underline font-medium">Lupa password?</a>
                    </div>
                    <div class="relative w-full" x-data="{ show: false }">
                        <input x-bind:type="show ? 'text' : 'password'" type="password" name="password" id="password" required
                            class="w-full bg-transparent border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3.5 pr-12 text-[#0a1f12] dark:text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-colors outline-none text-sm"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-[#9acb03] focus:outline-none transition-colors">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" style="display:none" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-[#9acb03] text-[#053d33] text-sm font-bold shadow-[0_8px_20px_rgba(154,203,3,0.25)] hover:shadow-[0_8px_25px_rgba(154,203,3,0.4)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Login Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center text-sm text-gray-500 dark:text-gray-400 font-light">
                <p>Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-[#075749] dark:text-[#9acb03] hover:underline transition-all">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
