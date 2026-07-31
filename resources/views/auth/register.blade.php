@extends('layouts.auth')

@section('content')
<section class="min-h-screen flex w-full">
    {{-- Left Side (Branding & Illustration) --}}
    <div class="hidden lg:flex w-1/2 relative bg-[#075749] flex-col justify-between p-12 lg:p-16 border-r border-white/10">
        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        {{-- Top: Logo --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-block">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                @endphp
                <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'HVM Digital') }}" class="h-10 w-auto">
            </a>
        </div>

        {{-- Center: Big Typography --}}
        <div class="relative z-10 my-auto pt-20">
            <h1 class="text-6xl lg:text-7xl font-bold text-white tracking-tight mb-6" style="line-height: 1.1;">
                Mulai<br>
                <span class="text-[#9acb03] italic pr-2">sekarang.</span>
            </h1>
            <p class="text-white/80 text-lg font-light max-w-md leading-relaxed">
                Bergabunglah dengan ratusan UMKM lainnya untuk mendigitalkan bisnis Anda dengan HVM Digital.
            </p>
        </div>

        {{-- Bottom: Footer Info --}}
        <div class="relative z-10 flex items-center justify-between text-white/50 text-xs font-light tracking-wide mt-12">
            <span>&copy; {{ date('Y') }} PT HVM Digital Solusindo</span>
            <span>Butuh bantuan? <a href="#" class="text-white/70 hover:text-[#9acb03] transition-colors">+62 812-1234-5678</a></span>
        </div>
    </div>

    {{-- Right Side (Form) --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-between bg-white dark:bg-[#061009] p-8 sm:p-12 lg:p-16 xl:p-24 overflow-y-auto max-h-screen">
        
        {{-- Top Right Link (Desktop only) --}}
        <div class="hidden lg:flex justify-end mb-8 shrink-0">
            <a href="{{ route('home') }}" class="text-xs font-medium text-gray-500 hover:text-gray-900 dark:hover:text-white flex items-center gap-2 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke beranda
            </a>
        </div>

        {{-- Mobile Logo --}}
        <div class="lg:hidden mb-12 shrink-0">
            <a href="{{ route('home') }}" class="inline-block">
                @php
                    $logoUrl = setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png');
                @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="h-8 w-auto">
            </a>
        </div>

        <div class="w-full max-w-sm mx-auto my-auto shrink-0">
            <div class="mb-10">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2 tracking-tight">Buat akun baru.</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light">Lengkapi data di bawah untuk membuat website bisnis Anda.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm font-medium border border-red-200">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                {{-- Minimalist Name Input --}}
                <div class="relative group">
                    <label for="name" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1 tracking-wide">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-transparent border-0 border-b border-gray-300 dark:border-gray-700 focus:border-[#075749] dark:focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-gray-900 dark:text-white font-medium text-base transition-colors"
                        placeholder="Budi Santoso">
                </div>

                {{-- Minimalist Email Input --}}
                <div class="relative group">
                    <label for="email" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1 tracking-wide">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-transparent border-0 border-b border-gray-300 dark:border-gray-700 focus:border-[#075749] dark:focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-gray-900 dark:text-white font-medium text-base transition-colors"
                        placeholder="nama@email.com">
                </div>

                {{-- Minimalist Phone Input --}}
                <div class="relative group">
                    <label for="phone" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1 tracking-wide">No. WhatsApp</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full bg-transparent border-0 border-b border-gray-300 dark:border-gray-700 focus:border-[#075749] dark:focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-gray-900 dark:text-white font-medium text-base transition-colors"
                        placeholder="08123456789">
                </div>

                {{-- Minimalist Password Input --}}
                <div class="relative group">
                    <label for="password" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1 tracking-wide">Password</label>
                    <div class="relative w-full" x-data="{ show: false }">
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            class="w-full bg-transparent border-0 border-b border-gray-300 dark:border-gray-700 focus:border-[#075749] dark:focus:border-[#9acb03] focus:ring-0 px-0 py-2 pr-10 text-gray-900 dark:text-white font-medium text-base transition-colors"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-2 flex items-center justify-center text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 outline-none">
                            <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Password Confirmation --}}
                <div class="relative group">
                    <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1 tracking-wide">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-transparent border-0 border-b border-gray-300 dark:border-gray-700 focus:border-[#075749] dark:focus:border-[#9acb03] focus:ring-0 px-0 py-2 text-gray-900 dark:text-white font-medium text-base transition-colors"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3.5 bg-[#1e293b] dark:bg-[#075749] text-white text-sm font-semibold hover:bg-black dark:hover:bg-[#053d33] transition-colors">
                        Buat Akun
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-sm text-gray-500 dark:text-gray-400 font-light space-y-2">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-gray-900 dark:text-white hover:underline">Masuk di sini</a></p>
            </div>
        </div>

        {{-- Bottom Right Footer (Mobile & Desktop) --}}
        <div class="mt-12 shrink-0 flex items-center justify-between lg:justify-end text-xs text-gray-400 dark:text-gray-500">
            <span class="lg:hidden">&copy; {{ date('Y') }} PT HVM Digital Solusindo</span>
            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300">Syarat & Ketentuan</a>
        </div>
    </div>
</section>
@endsection
